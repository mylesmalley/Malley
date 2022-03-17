<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WizardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
/** @lang text */
<<<'SQL'
    create table wizards
    (
        id int identity
            constraint wizard_pk
                primary key nonclustered,
        name nvarchar(250) not null,
        start int
    )

    create table wizard_actions
    (
        id int identity
            constraint wizard_actions_pk
                primary key nonclustered,
        wizard_answer_id int not null,
        option_id int not null,
        action nvarchar(10) not null,
        value int not null
    )


    create table wizard_answers
    (
        id int identity
            constraint wizard_answers_pk
                primary key nonclustered,
        text nvarchar(250),
        next int,
        wizard_question_id int not null,
        notes nvarchar(250),
        wizard_id int
    )


    create table wizard_questions
    (
        id int identity
            constraint wizard_questions_pk
                primary key nonclustered,
        wizard_id int,
        text nvarchar(250),
        notes nvarchar(250),
        type nvarchar(25),
        redirect_method nvarchar(30)
    )

    create table blueprint_wizard_answers
    (
        id int identity
            constraint blueprint_wizard_answers_pk
                primary key nonclustered,
        blueprint_id int,
        wizard_answer_id int,
        wizard_question_id int,
        wizard_id int
    )

SQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wizards');
        Schema::dropIfExists('wizard_questions');
        Schema::dropIfExists('wizard_actions');
        Schema::dropIfExists('wizard_answers');
        Schema::dropIfExists('blueprint_wizard_answers');
    }
}
