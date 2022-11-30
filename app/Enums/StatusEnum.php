<?php

namespace App\Enums;

enum StatusEnum:string {
    case Published = 'published';
    case Process = 'process';
    case Reject = 'rejected';
    case Draft = 'draft';
    case Private = 'private';
}
