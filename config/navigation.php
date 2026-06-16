<?php

return [

    'admin' => [
        ['label' => 'Curriculum Builder', 'route' => 'admin.curriculum-builder'],
        ['label' => 'Prospectus Preview', 'route' => 'admin.prospectus-preview'],
        ['label' => 'Publish Curriculum', 'route' => 'admin.publish-curriculum'],
    ],

    'our' => [
        ['label' => 'Dashboard', 'route' => 'our.dashboard'],
        ['label' => 'Programs', 'route' => 'our.dashboard', 'disabled' => true],
        ['label' => 'Reports', 'route' => 'our.dashboard', 'disabled' => true],
    ],

    'adviser' => [
        ['label' => 'Dashboard', 'route' => 'adviser.dashboard'],
        ['label' => 'My Advisees', 'route' => 'adviser.dashboard', 'disabled' => true],
        ['label' => 'Schedules', 'route' => 'adviser.dashboard', 'disabled' => true],
    ],

    'student' => [
        ['label' => 'Dashboard', 'route' => 'student.dashboard'],
        ['label' => 'My Adviser', 'route' => 'student.dashboard', 'disabled' => true],
        ['label' => 'Enrollment', 'route' => 'student.dashboard', 'disabled' => true],
    ],

    'evaluator' => [
        ['label' => 'Dashboard', 'route' => 'evaluator.dashboard'],
        ['label' => 'Evaluations', 'route' => 'evaluator.dashboard', 'disabled' => true],
        ['label' => 'Reports', 'route' => 'evaluator.dashboard', 'disabled' => true],
    ],

];
