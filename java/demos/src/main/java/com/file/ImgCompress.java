package com.file;

import com.sun.image.codec.jpeg.JPEGCodec;
import com.sun.image.codec.jpeg.JPEGImageEncoder;

import javax.imageio.ImageIO;
import javax.swing.*;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.Date;

/**
 * 图片处理
 * 切割、压缩图片
 */
public class ImgCompress {
    private Image img;
    private int width;
    private int height;

    @SuppressWarnings("deprecation")
    public static void main(String[] args) throws Exception {
        System.out.println("开始：" + new Date().toLocaleString());
        ImgCompress imgCom = new ImgCompress("/Users/ziying/Downloads/wwww.jpg");
        imgCom.resizeFix(170, 170);
        System.out.println("结束：" + new Date().toLocaleString());
    }

    /**
     * 构造函数
     */
    public ImgCompress(String fileName) throws IOException {
        // 读入文件
        File file = new File(fileName);
        // 构造Image对象
        //img = ImageIO.read(file);
        // 解决图片变色问题
        Image src = Toolkit.getDefaultToolkit().getImage(file.getPath());
        img = toBufferedImage(src);
        // 得到源图宽
        width = img.getWidth(null);
        // 得到源图长
        height = img.getHeight(null);
    }

    /**
     * 按照宽度还是高度进行压缩
     *
     * @param w int 最大宽度
     * @param h int 最大高度
     */
    public void resizeFix(int w, int h) throws IOException {
        if (width / height > w / h) {
            resizeByWidth(w);
        } else {
            resizeByHeight(h);
        }
    }

    /**
     * 以宽度为基准，等比例放缩图片
     *
     * @param w int 新宽度
     */
    public void resizeByWidth(int w) throws IOException {
        int h = (height * w / width);
        resize(w, h);
    }

    /**
     * 以高度为基准，等比例缩放图片
     *
     * @param h int 新高度
     */
    public void resizeByHeight(int h) throws IOException {
        int w = (width * h / height);
        resize(w, h);
    }

    /**
     * 强制压缩/放大图片到固定的大小
     *
     * @param w int 新宽度
     * @param h int 新高度
     */
    public void resize(int w, int h) throws IOException {
        BufferedImage image = new BufferedImage(w, h, BufferedImage.TYPE_INT_RGB);
        // 绘制缩小后的图
        image.getGraphics().drawImage(img, 0, 0, w, h, null);
        // 使用 SCALE_SMOOTH 的缩略算法 生成缩略图片的平滑度高，图片质量比较好，但速度慢
        //image.getGraphics().drawImage(img.getScaledInstance(w, h, Image.SCALE_SMOOTH), 0, 0, null);
        File destFile = new File("/Users/ziying/Downloads/170x170.JPG");
        // 输出到文件流
        FileOutputStream out = new FileOutputStream(destFile);
        // 可以正常实现bmp、png、gif转jpg
        JPEGImageEncoder encoder = JPEGCodec.createJPEGEncoder(out);
        // JPEG编码
        encoder.encode(image);
        out.close();
    }

    public static BufferedImage toBufferedImage(Image image) {
        if (image instanceof BufferedImage) {
            return (BufferedImage) image;
        }
        // This code ensures that all the pixels in the image are loaded
        image = new ImageIcon(image).getImage();
        BufferedImage bimage = null;
        GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
        try {
            int transparency = Transparency.OPAQUE;
            GraphicsDevice gs = ge.getDefaultScreenDevice();
            GraphicsConfiguration gc = gs.getDefaultConfiguration();
            bimage = gc.createCompatibleImage(image.getWidth(null), image.getHeight(null), transparency);
        } catch (HeadlessException e) {
            // The system does not have a screen
        }
        if (bimage == null) {
            // Create a buffered image using the default color model
            int type = BufferedImage.TYPE_INT_RGB;
            bimage = new BufferedImage(image.getWidth(null), image.getHeight(null), type);
        }
        // Copy image to buffered image
        Graphics g = bimage.createGraphics();
        // Paint the image onto the buffered image
        g.drawImage(image, 0, 0, null);
        g.dispose();
        return bimage;
    }
}
