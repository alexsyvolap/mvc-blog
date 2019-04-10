$( document ).ready(function() {
    const createPostForm = $('#createPostForm');
    const sendPostButton = $('#sendPost');
    const modalCreatePost = $('#createPost');
    const modalError = $('#error');
    const posts = $('.posts');
    const deletePosModal = $('#deletePost');
    const deletePostButton = $('#deletePostButton');
    const editPostModal = $('#editPost');
    const editPostButton = $('#editPostButton');
    const editPostForm = $('#editPostForm');
    const post = $('.post');

    const commentForm = $('#commentForm');
    const sendCommentButton = $('#sendComment');
    const commentBody = $('.commentBody');
    const commentCounts = $('#commentCount');

    const postTitle = $('span #titleModal');
    const postStatus = $('span #status');
    const postContent = $('p #content');
    const postTags = $('span #tags');

    sendPostButton.on('click', function() {
        $.ajax({
            type: 'POST',
            url: "/news/create",
            data: createPostForm.serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if(data != null) {
                    modalCreatePost.modal('toggle');
                    resetDataForm();
                    posts.prepend(generatePost(data));
                } else {
                    modalCreatePost.modal('toggle');
                    modalError.modal('toggle');
                }
            },
            error: function (data) {
                modalCreatePost.modal('toggle');
                modalError.modal('toggle');
            }
        });
    });

    function resetDataForm() {
        modalCreatePost.find('#title').val('');
        modalCreatePost.find('#status').val('');
        modalCreatePost.find('#content').val('');
        modalCreatePost.find('#tags').val('');
    }

    function generatePost(data) {
        html = '<div class="card mb-2" data-id="'+data.id+'">\n' +
            '    <div class="card-header">\n' +
            '        <span id="title" class="mr-2"><a href="/news/'+data.id+'">'
                    +data.title+
            '        </a></span>\n' +
            ' ' + generateStatus(data.status) + ' ' +
            '    </div>\n' +
            '    <div class="card-body">\n' +
            '        <p id="content">'+data.content+'</p>\n' +
            ' ' + generateTags(data.tags) + ' <br>' +
            ' Количество комментариев: ' + 0 + ' ' +
            '    </div>\n' +
            '</div>';
        return html;
    }

    function generateStatus(status) {
        if(status == 0) {
            return '<span id="status" class="badge badge-primary">Новый</span>';
        } else if(status == 1) {
            return '<span id="status" class="badge badge-success">Открытый</span>';
        } else if(status == 2) {
            return '<span id="status" class="badge badge-danger">Закрытый</span>';
        }
    }

    function generateTags(tags) {
        return '<span id="tags">Теги: '+tags+'</span>';
    }

    deletePostButton.on('click', function () {
        id = post.data('id');
        $.ajax({
            type: 'POST',
            url: "/news/delete/"+id,
            dataType: 'json',
            success: function (data) {
                $(location).attr('href', '/news');
            },
            error: function (data) {
                deletePosModal.modal('toggle');
                modalError.modal('toggle');
            }
        });
    });

    editPostButton.on('click', function () {
        postId = post.data('id');
        $.ajax({
            type: 'POST',
            url: "/news/edit/"+postId,
            dataType: 'json',
            data: editPostForm.serialize(),
            success: function (data) {
                editPostModal.modal('toggle');
                changeText(data);
                $('#status').empty().removeClass('badge-primary').removeClass('badge-success').removeClass('badge-danger')
                    .addClass(getStatusNameAndCalss(data.status)[0]).text(getStatusNameAndCalss(data.status)[1]);
            },
            error: function (data) {
                editPostModal.modal('toggle');
                modalError.modal('toggle');
            }
        });
    });

    function getStatusNameAndCalss(status) {
        if(status == 0) {
            return ['badge-primary', 'Новый']
        } else if(status == 1) {
            return ['badge-success', 'Открытый']
        } else if(status == 3) {
            return ['badge-danger', 'Закрытый']
        }
    }

    function changeText(data) {
        $('#title').empty().text(data.title);
        $('#content').empty().text(data.content);
        $('#tags').empty().text('Теги: ' + data.tags);
    }

    sendCommentButton.on('click', function () {
        postId = post.data('id');
        if(isValidEmailAddress(commentForm.find('#mail').val())) {
            $.ajax({
                type: 'POST',
                url: "/news/"+postId+'/comment',
                dataType: 'json',
                data: commentForm.serialize(),
                success: function (data) {
                    if(data != null) {
                        commentBody.append(generateComment(data));
                        commentForm.find('#mail').removeClass('border border-danger').val('');
                        commentForm.find('#comment').val('');
                        $.ajax({
                            type: 'GET',
                            url: "/news/"+data.post_id+'/comment/count',
                            dataType: 'json',
                            success: function (data) {
                                $('#commentCount').text(data)
                            },
                            error: function (data) {
                                return false;
                            }
                        });
                    } else {
                        modalError.modal('toggle');
                    }
                },
                error: function (data) {
                    modalError.modal('toggle');
                }
            });
        } else {
            commentForm.find('#mail').addClass('border border-danger');
        }
    });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }

    function generateComment(data) {
        html = '<div class="card mb-2" data-id="'+data.id+'">\n' +
            '        <div class="card-header">'+data.email+'</div>\n' +
            '        <div class="card-body">'+data.content+'</div>\n' +
            '    </div>'
        return html;
    }

});