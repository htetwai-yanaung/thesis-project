<?php

namespace Modules\Core\Constant;

class Constants
{
    //role
    const admin = 1;
    const teacher = 2;
    const student = 3;

    //image path
    const profileImagePath = 'public/uploads/profile';
    const projectImagePath = 'public/uploads/project';
    const projectPdfPath = 'public/uploads/document';
    const uploadsPath = 'public/uploads';

    //image type
    const imageFileType = 'img';
    const pdfFileType = 'pdf';
    const projectImageType = 'project';
    const newsImageType = 'news';

    //project status
    const approved = 1;
    const pending = 2;
    const rejected = 3;
}
