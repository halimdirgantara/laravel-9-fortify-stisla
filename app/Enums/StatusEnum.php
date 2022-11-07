<?php

namespace App\Enums;

enum StatusEnum:string {
    case Published = 'published';
    case Process = 'processed';
    case Reject = 'rejected';
    case Draft = 'draft';
    case Private = 'private';
}
