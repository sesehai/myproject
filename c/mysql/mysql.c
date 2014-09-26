#include "mysql.h"

MYSQL *get_connect(MYSQL_CONNECT_CONF conConf){
    MYSQL *connect;

    connect = mysql_init(NULL);
    if (!connect) {
        //fprintf(stderr, "mysql_init failed\n");
        return connect;
    }

    connect = mysql_real_connect(connect, conConf.host, conConf.user, conConf.passwd, conConf.db, conConf.port, conConf.unix_socket, conConf.client_flag);

    if (connect) {
        mysql_set_character_set(connect, conConf.character_set);
        //printf("Connection success\n");
    } else {
        //printf("Connection failed\n");
    }

    return connect; 
}

SQL_ROW_DATA execute_sql(MYSQL *connect, char *sql){
    int res;
    MYSQL_RES *result = 0;
    SQL_ROW_DATA row_data;
    res = mysql_query(connect, sql);
    if (res) {
        //printf("SELECT error: %s\n", mysql_error(connect));
    } else {
        result = mysql_store_result(connect);
        row_data = fetch_all_rows(result);
    }

    return row_data;
}

SQL_ROW_DATA fetch_all_rows(MYSQL_RES *result){
    SQL_ROW_DATA row_data;
    SQL_ROW *rows = NULL;
    MYSQL_ROW mysqlrow;
    MYSQL_FIELD *fields;
    int col_index;
    int row_index = 0;
    int num_fields;
    int num_rows;
    SQL_COL *col_array = 0;
    if (result) {
        num_rows = mysql_num_rows(result);
        num_fields = mysql_num_fields(result);
        fields = mysql_fetch_fields(result);
        rows = (SQL_ROW *)malloc(sizeof(SQL_ROW)*num_rows);
        while ((mysqlrow = mysql_fetch_row(result))) {
            col_array = (SQL_COL *)malloc(sizeof(SQL_COL)*num_fields);
            rows[row_index].cols = col_array;

            for (col_index = 0; col_index < num_fields; col_index++) {
                if (fields[col_index].name){
                    col_array[col_index].name = strdup(fields[col_index].name);
                }else{
                    col_array[col_index].name = "-";
                }
                if (mysqlrow[col_index]){
                    col_array[col_index].data = strdup(mysqlrow[col_index]);
                }else{
                    col_array[col_index].data = "";
                }
            }

            row_index++;
        }

        mysql_free_result(result);
    }
    
    row_data.row_num = num_rows;
    row_data.col_num = num_fields;
    row_data.rows = rows;
    return row_data;
}

void free_data_rows(SQL_ROW_DATA row_data){
    SQL_COL *cur_col;
    int i;
    
    for(i = 0; i < row_data.row_num; i++){
        cur_col = row_data.rows[i].cols;
        free(cur_col);
    }

    free(row_data.rows);
}

void print_rows(SQL_ROW_DATA row_data){
    int row_index;
    int col_index;
    for(row_index = 0; row_index < row_data.row_num; row_index++){
        fprintf(stderr, "[*] Row #%d\n", row_index);
        for (col_index = 0; col_index < row_data.col_num; col_index++)
        {
            fprintf(stderr, "[*] \t%s = %s\n", row_data.rows[row_index].cols[col_index].name, row_data.rows[row_index].cols[col_index].data);
        }

        fprintf(stderr, "\n");
    }
}