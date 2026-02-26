<?php

namespace App\Constants;

use App\Models\Feature;

class FeatureKey
{
    public const CULT_MODULE = 'cult_module';
    public const LESSON_MODULE = 'lesson_module';
    public const MEMBER_MODULE = 'member_module';
    public const SCHOOL_MODULE = 'school_module';
    public const PROJECT_MODULE = 'project_module';
    public const MODALITY_MODULE = 'modality_module';

    public const CULT_LIMIT = 'cult_limit';
    public const LESSON_LIMIT = 'lesson_limit';
    public const MEMBER_LIMIT = 'member_limit';
    public const SCHOOL_LIMIT = 'school_limit';
    public const PROJECT_LIMIT = 'project_limit';
    public const MODALITY_LIMIT = 'modality_limit';

    public static function all(): array
    {
        return [
            self::CULT_MODULE => 'Módulo de Cultos',
            self::LESSON_MODULE => 'Módulo de Aulas',
            self::MEMBER_MODULE => 'Módulo de Membros',
            self::SCHOOL_MODULE => 'Módulo de Escolas',
            self::PROJECT_MODULE => 'Módulo de Projetos',
            self::MODALITY_MODULE => 'Módulo de Modalidades',
            self::CULT_LIMIT => 'Limite de Cultos',
            self::LESSON_LIMIT => 'Limite de Aulas',
            self::MEMBER_LIMIT => 'Limite de Membros',
            self::SCHOOL_LIMIT => 'Limite de Escolas',
            self::PROJECT_LIMIT => 'Limite de Projetos',
            self::MODALITY_LIMIT => 'Limite de Modalidades',
        ];
    }

    public static function listUpdated()
    {
        $features = Feature::all()->pluck('name', 'key')->toArray();

        return array_diff_key(self::all(), $features);
    }
}