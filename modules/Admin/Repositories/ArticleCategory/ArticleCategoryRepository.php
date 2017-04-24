<?php

namespace Modules\Admin\Repositories\ArticleCategory;

interface ArticleCategoryRepository {

    /**
     * Add a new Category to a Article.
     *
     * @param string $ArticleID
     * 
     * @param string $Category
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function linkCategoryWithArticle($articleID, $categoryID);

    /**
     * Get all the Categorys for a specific Article.
     *
     * @param String $ArticleID
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllCategories($articleID);

    /**
     * Remove all the Categorys of a partcular Article.
     *
     * @param int $ArticleID
     *
     * @param string $Category
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllCategories($articleID);
}
