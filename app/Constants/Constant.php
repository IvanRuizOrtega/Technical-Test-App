<?php

namespace App\Constants;

class Constant 
{
    const   PAGE_NUMBER = 2, // CONSTANTES DE PAGINACION

            AUTH = 'auth', // LOGIN POR SANCTUM 

            SORT_BY = 'created_at',  DESC =  'DESC', ASC = 'ASC', // ORDENAR POR FECHA DE CREACION, DE ORDEN DESC - ASC

            COURSE_HOME = 'courses.index', ID_TYPE_HOME = 'identification-types.index',

            PERIOD_HOME = 'periods.index', STUDENT_HOME = 'students.index', SUBJECT_HOME = 'subjects.index' ; // HOME DE LAS ENTOIDADES            
}