<?php

class FileUploader
{

    const FILE_DIR = "uploads/"; // Константа, определяющая папку для работы с файлами

    public function UploadFile($fileName, $tmpFileName) // Метод загрузки файлов, со свойством public (общедоступный)
    {

        if (empty($fileName)) {  // Выход из функции, если значение переменной не присвоено
            return;
        }


        if (!is_dir(static::FILE_DIR)) // Проверка наличия папки. Если нету: создать с полным доступом
        {
            mkdir(static::FILE_DIR, 0777);
        }


        $uploadfile = static::FILE_DIR . $fileName; // Создание переменной пути к файлу для использования в следующем условии


        if (move_uploaded_file($tmpFileName, $uploadfile)) // Условие записи файла в /uploads
        {
            $result= "<p>Загрузка успешно выполнена!</p>";
        }
        else
            {
                $result= "<b>Ошибка загрузки!</b>";
            }

    return $result;
    }

}
