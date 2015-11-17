<?php namespace App\Services;

class FileService {

    private $img_extensions = ['gif', 'png', 'jpg', 'jpeg', 'JPG', 'JPEG'];

    /**
     * Validate an image file.
     * Check the extension, if the file already exists and its size.
     *
     * @param $file
     * @return array3
     */
    public function validateImage($file) {

        $flag = false;
        $message = "null";

        if ($file != null) {

            $filename = public_path() . '/uploads/missions/' . $file->getClientOriginalName();

            //if file already exists, redirect back with error message
            if (file_exists($filename)) {
                $flag = true;
                $message = 'Το αρχείο ' . $file->getClientOriginalName() . ' υπάρχει ήδη.';
            }

            //if file exceeds maximum allowed size, redirect back with error message
            if ($file->getSize() > 10000000) {
                $flag = true;
                $message = 'Το αρχείο ' . $file->getClientOriginalName() . ' ξεπερνά σε μέγεθος τα 10mb.';
            }

            //if file is not an image, redirect back with an error
            if (!in_array($file->getClientOriginalExtension(), $this->img_extensions)) {
                $flag = true;
                $message = 'Το αρχείο ' . $file->getClientOriginalName() . ' δεν είναι εικόνα.';
            }
        }

        return ['error' => $flag, 'message' => $message];
    }
}
