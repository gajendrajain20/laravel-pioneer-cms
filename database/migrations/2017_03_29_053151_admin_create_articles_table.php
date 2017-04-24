<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('articles');
        Schema::create('articles', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('type')->default('post'); // post, page
            $table->integer('user_id');
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug');
            $table->text('body');
            $table->string('image')->nullable();
            $table->tinyInteger('show_featured_image')->default('0');
            $table->integer('views')->default('0');
            $table->integer('status')->default('1');
            $table->dateTime('published_on');
            $table->timestamp('published_at')->nullable()->useCurrent();
            $table->timestamps();
            });
        
        DB::unprepared('DROP PROCEDURE IF EXISTS get_tree;');
        DB::unprepared(
            "
                CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tree`(IN `root` INT)
                BEGIN
                 select  id,
                        title,
                        parent 
                from    (select * from menus
                         order by parent, id) base,
                        (select @pv := root) tmp
                where   find_in_set(parent, @pv) > 0
                and     @pv := concat(@pv, ', 
            ', id) ;
                END
            ");
        
        DB::unprepared('DROP PROCEDURE IF EXISTS getArticlesMonthList;');
        DB::unprepared(
            "
            CREATE DEFINER=`root`@`localhost` PROCEDURE `getArticlesMonthList`()
            BEGIN
            SELECT DISTINCT concat(concat(left(monthname(published_on),3),' '),year(published_on)) as dates from articles where type='post' order by published_on;
            END
            ");
        
        DB::unprepared('DROP PROCEDURE IF EXISTS getPagesMonthList;');
        DB::unprepared(
            "
            CREATE DEFINER=`root`@`localhost` PROCEDURE `getPagesMonthList`()
            BEGIN
            SELECT DISTINCT concat(concat(left(monthname(published_on),3),' '),year(published_on)) as dates from articles where type='page' order by published_on;
            END
            ");
        
        DB::unprepared('DROP PROCEDURE IF EXISTS getVideosMonthList;');
        DB::unprepared(
            "
            CREATE DEFINER=`root`@`localhost` PROCEDURE `getVideosMonthList`()
            BEGIN
            SELECT DISTINCT concat(concat(left(monthname(published_on),3),' '),year(published_on)) as dates from videos order by published_on;
            END
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_tree;');
        DB::unprepared('DROP PROCEDURE IF EXISTS getArticlesMonthList;');
        DB::unprepared('DROP PROCEDURE IF EXISTS getPagesMonthList;');
        DB::unprepared('DROP PROCEDURE IF EXISTS getVideosMonthList;');
    }
}
