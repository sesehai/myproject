#ifndef _MYSQL_DB_H
#define _MYSQL_DB_H

#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <mysql.h>

typedef struct _mysql_onnect_conf {
    const char *host;
    const char *user;
    const char *passwd;
    const char *db;
    unsigned int port;
    const char *unix_socket;
    unsigned long client_flag;
    char *character_set;
} MYSQL_CONNECT_CONF;

typedef struct _sql_col {
    char *name;
    char *data;
} SQL_COL;

typedef struct _sql_row {
    SQL_COL *cols;
} SQL_ROW;

typedef struct _sql_row_data {
    int row_num;
    int col_num;
    SQL_ROW *rows;
} SQL_ROW_DATA;

MYSQL *get_connect(MYSQL_CONNECT_CONF conConf);
SQL_ROW_DATA execute_sql(MYSQL *connect, char *sql);
SQL_ROW_DATA fetch_all_rows(MYSQL_RES *result);
void free_data_rows(SQL_ROW_DATA row_data);
void print_rows(SQL_ROW_DATA row_data);

#endif