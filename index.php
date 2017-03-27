<form method="POST" enctype="multipart/form-data">
    <input type="file" name="files" value=""/>
    <input type="submit" value="Upload File"/>
</form>
<?php
require __DIR__. '/vendor/autoload.php';

$storage = new \Upload\Storage\FileSystem('assets');
$file = new \Upload\File('files', $storage);

// Optionally you can rename the file on upload
$new_filename = uniqid();
$file->setName($new_filename);

// Validate file upload
// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
$file->addValidations(array(
    // Ensure file is of type "image/png"
    new \Upload\Validation\Mimetype(array(
        'image/png', 'image/jpeg', 'application/msword', 'application/zip'
    )),

    //You can also add multi mimetype validation
    //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
    new \Upload\Validation\Size('5M')
));

// Access data about the file that has been uploaded
$data = array(
    'name'       => $file->getNameWithExtension(),
    'extension'  => $file->getExtension(),
    'mime'       => $file->getMimetype(),
    'size'       => $file->getSize(),
    'md5'        => $file->getMd5(),
    'dimensions' => $file->getDimensions()
);

// Try to upload file
try {
    // Success!
    $file->upload();
?>
File berhasil terupload
    <table border="1">
        <tr>
            <th>Name</th>
            <th><?=$data['name']?></th>
        </tr>

        <tr>
            <th>Extension</th>
            <th><?=$data['extension']?></th>
        </tr>

        <tr>
            <th>Mime</th>
            <th><?=$data['mime']?></th>
        </tr>

        <tr>
            <th>Md5</th>
            <th><?=$data['md5']?></th>
        </tr>
        <tr>
            <th>Dimensions</th>
            <th><?=$data['dimensions']['width']?> x <?=$data['dimensions']['height']?></th>
        </tr>
    </table>
<?php
} catch (\Exception $e) {
    // Fail!
    $errors = $file->getErrors();
    var_dump($errors);
}
