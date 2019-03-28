<?php

class FileActions {

  public function FileDownload($fileName) // Метод скачивания файла, со свойством public (общедоступный)
  {
      if (is_file(FileUploader::FILE_DIR . $fileName)) // Проверка наличия файла, затем скачивание
      {

        // Вывод окна сохранения файла, после нажатия "Скачать" в строке файла

        header('Content-Description: File Transfer');
        header('Content-Type:application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename(FileUploader::FILE_DIR . $fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize(FileUploader::FILE_DIR . $fileName));
        readfile(FileUploader::FILE_DIR . $fileName);
        exit;
      }

    }

    public function FileDelete($fileName) // Метод для удаления файлов, со свойством public (общедоступный)
    {
        if (is_file(FileUploader::FILE_DIR . $fileName)) // Проверка наличия файла
        {
        unlink(FileUploader::FILE_DIR . $fileName); // Удаление файла
        }




    }


}
