<?php

namespace App;

class Lang {

    /**
     * @return array
     * Языковой пакет
     */
    public static function getRu()
    {
        return [

            'posts' => [
                'status' => [
                    'new' => 'Новый',
                    'open' => 'Открытый',
                    'closed' => 'Закрытый',
                ],
                'field' => [
                    'commentsCount' => 'Количество комментариев',
                    'tags' => 'Теги',
                    'comments' => 'Комментарии',
                    'mail' => 'Почта',
                    'comment' => 'Комментарий',
                    'title' => 'Заголовок',
                    'content' => 'Содержание',
                    'status' => 'Статус',
                    'images' => 'Картинки',
                ],
                'pages' => [
                    'news' => 'Новости',
                    'newsId' => 'Новость',
                    'createPost' => 'Создание новости',
                ],
                'action' => [
                    'send' => 'Отправить',
                    'createPost' => 'Создать новость',
                    'create' => 'Создать',
                    'close' => 'Закрыть',
                    'delete' => 'Удалить',
                    'edit' => 'Редактировать',
                ],
                'modal' => [
                    'createPost' => 'Создание нового поста',
                    'error' => 'Ошибка',
                    'editPost' => 'Редактирование поста',
                    'deletePost' => 'Удаление поста',
                ]
            ]

        ];
    }

}
