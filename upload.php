<?php
// تحديد مجلد التخزين
$uploadDir ="grades";

// إنشاء المجلد إذا لم يكن موجودًا
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// التحقق من وجود ملفات مرفوعة
if (!empty($_FILES['files']['name'][0])) {
    foreach ($_FILES['files']['name'] as $key => $fileName) {
        $fileTmpName = $_FILES['files']['tmp_name'][$key];
        $fileType = $_FILES['files']['type'][$key];

        // التحقق من صيغة الملف (PDF فقط)
        if ($fileType === "application/pdf") {
            $destination = $uploadDir . basename($fileName);

            // نقل الملف إلى المجلد
            if (move_uploaded_file($fileTmpName, $destination)) {
                echo "تم رفع الملف: $fileName<br>";
            } else {
                echo "حدث خطأ أثناء رفع الملف: $fileName<br>";
            }
        } else {
            echo "الملف $fileName ليس بصيغة PDF.<br>";
        }
    }
} else {
    echo "لم يتم رفع أي ملفات.";
}
?>
