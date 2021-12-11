<?php


namespace App\Enum;


use BenSampo\Enum\Enum;

class TaskState extends Enum
{
    const Init = 'Instantiated';
    const InWork = 'In Work';
    const Finish = 'Finished';
    const Abort = 'Aborted';

}
