package com.file;

import java.io.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Comparator;
import java.util.List;

/**
 * Created by ziying on 2017/10/18.
 */
public class Download {
    /**
     * 传入要下载的图片的url列表，将url所对应的图片下载到本地
     * @param urlList
     */
    public static void downloadPicture(List<String> urlList) {
        URL url = null;

        for (String urlString : urlList) {
            try {
                url = new URL(urlString);
                String filePath = url.getFile();
                String fileName = filePath.substring(filePath.lastIndexOf(File.separator) + 1);

                System.out.println(fileName);
                DataInputStream dataInputStream = new DataInputStream(url.openStream());
                String imageName = "/Users/ziying/Downloads/downImg/" + fileName;
                FileOutputStream fileOutputStream = new FileOutputStream(new File(imageName));

                byte[] buffer = new byte[1024];
                int length;

                while ((length = dataInputStream.read(buffer)) > 0) {
                    fileOutputStream.write(buffer, 0, length);
                }

                dataInputStream.close();
                fileOutputStream.close();
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    public static void main(String[] args) {
//        List<String> urlList =  new ArrayList<String>();
//        urlList.add("http://www.yourdomain.com/theme/default/images/main/zt-logo.png ");
//        downloadPicture(urlList);
//        try {
//            ObjectOutputStream out = new ObjectOutputStream(new FileOutputStream("/Users/ziying/Downloads/downImg/obj.txt"));
//            out.writeObject("Hello");
//        } catch (IOException e) {
//            e.printStackTrace();
//        }

//        try{
//            int n = 0;
//            int m = 1;
//            int l = m/n;
//            try{
//                System.out.println("in ok");
//
//                throw new Exception("in error");
//            }catch (Exception e){
//                System.out.println(e.getMessage());
//            }finally {
//                System.out.println("finally");
//            }
//        }catch (Exception e){
//            System.out.println(e.getMessage());
//        }

    }
}
