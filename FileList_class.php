<?php

class FileList
{

  public function FilesList() // Метод построения строк в таблице файлов, которые в папке, со свойством public (общедоступный)
{

  $list = $this->ReadFiles();
  $table = '';
  foreach ($list as $item) {
      $fileDate = date('Загружено: d.m.Y; Время: H:i', $item['date']);
      $name = $item['name'];
      $size = $item['size'];
      $table .= "

      <tr>
      <form action='' method='POST'>

      <td>$fileDate</td>
      <td>$name</td>
      <td>$size</td>

      <td>
      <input type='submit' name='download' value='Скачать'>
      <input type='hidden' name='download_file' value='$name'>
      </td>

      <td>
      <input type='submit' name='delete' value='Удалить'>
      <input type='hidden' name='delete_file' value='$name'>
      </td>

      </form>
      </tr>";
  }

  return $table;

  }

  public function ReadFiles() // Объявление метода получения массива с атрибутами файлов в папке, с общедоступным свойством
    {
        $fileList = []; // Создание массива
        $fileNames = scandir(FileUploader::FILE_DIR);
        foreach ($fileNames as $key => $fileName)
    {
            if ($fileName == '.' || $fileName == '..') // Если Scandir возвращает . и .., то пропустить
            {
                continue;
            }
            $size = filesize(FileUploader::FILE_DIR . $fileName); // Создание многомерного массива с атрибутами файлов в папке
            $fileDate = filemtime(FileUploader::FILE_DIR . $fileName);
            $fileList[$key]['name'] = $fileName;
            $fileList[$key]['size'] = $size . " bytes";
            $fileList[$key]['date'] = $fileDate;
            }

        return $fileList;

    }
}
