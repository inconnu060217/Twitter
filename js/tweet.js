$(document).ready(async () => {
    let current = window.location.href;
    let baseUrl = current.slice(0, current.lastIndexOf('/'));
    let url = baseUrl + '/controllers/ajaxTweet.php';

    let postRequest = async (form, bool = true) => {
        let result;
        await $.ajax({
            type: "POST",
            url: url,
            data: form,
            success: (res) => result = bool ? JSON.parse(res) : console.log(res),
            error: (res) => console.log(res)
        })
        return result;
    }


    let profile = await postRequest({ util: 'profile' });

    console.log(url, profile);

    let tweet_container = $('.tweet_container');
    tweet_container.on('mouseup', (e) => {
        let target = $(e.target);
        if (target.hasClass('btn') || target.parents('.btn').hasClass('btn')) return;
        let id = $(e.currentTarget).data('id');
        window.location.href = `${baseUrl}/tweet.php?id=${id}`;
    });


    let comment = $('.btn[data-role="comment"]');
    let tweet = $('.btn[data-role="tweet"]');

    let showModal = ({ target, role } = {}) => {
        if (!profile) return;
        let background = $('<div class="modal"></div>');
        let container = $('<div class="modal_container light"></div>');
        let header = $('<div class="modal_header"></div>');
        let body = $('<div class="modal_body row"></div>');
        let footer = $('<div class="modal_footer">');
        let svg = $('<button class="btn"><svg viewBox="0 0 24 24" class="small_icons" fill="rgb(29, 161, 242)"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></button>')

        let string = {
            btn: role == 'comment' ? 'Répondre' : 'Tweeter',
            placeholder: role == 'comment' ? 'Tweetez votre réponse.' : 'Quoi de neuf ?'
        };

        if (role == 'comment') {
            let div = $('<div class="col-12"></div>');
            let clone = target.clone();

            clone.removeClass('tweet_container');
            clone.removeClass('p-3');
            clone.find('.btn').remove();
            div.append(clone);
            body.append(div);
        }

        let modal_text = $('<div class="modal_text col-10"></div>');
        let contenteditable = $('<div contenteditable="true" class="modal_content" placeholder="Tweeter votre réponse."></div>');
        let modal_pic_holder = $('<div class="col-2"></div>');
        let profile_pic = $(`<div class="tweet_profile_pic light"><img src="images/pictures/${profile.picture}" style="width:100%; height:100%;"/></div>`);
        let send = $(`<button class="btn modal_send">${string.btn}</button>`);
        let placeholder = $(`<div class="modal_placeholder">${string.placeholder}</div>`);
        let imageBtn = $('<button class="btn modal_image"><svg viewBox="0 0 24 24" class="small_icons" fill="rgb(29, 161, 242)"><g><path d="M19.75 2H4.25C3.01 2 2 3.01 2 4.25v15.5C2 20.99 3.01 22 4.25 22h15.5c1.24 0 2.25-1.01 2.25-2.25V4.25C22 3.01 20.99 2 19.75 2zM4.25 3.5h15.5c.413 0 .75.337.75.75v9.676l-3.858-3.858c-.14-.14-.33-.22-.53-.22h-.003c-.2 0-.393.08-.532.224l-4.317 4.384-1.813-1.806c-.14-.14-.33-.22-.53-.22-.193-.03-.395.08-.535.227L3.5 17.642V4.25c0-.413.337-.75.75-.75zm-.744 16.28l5.418-5.534 6.282 6.254H4.25c-.402 0-.727-.322-.744-.72zm16.244.72h-2.42l-5.007-4.987 3.792-3.85 4.385 4.384v3.703c0 .413-.337.75-.75.75z"></path><circle cx="8.868" cy="8.309" r="1.542"></circle></g></svg></button>"'); 
        let imageInput = $('<input type="file" style="display:none;"></input>'); 

        contenteditable.on('keypress keydown paste cut', async (e) => {
            let text = contenteditable.text();
            let length = text.length;
            let selection = window.getSelection().toString();
            let event = e.originalEvent;
            length >= 140 ? e.preventDefault() : null;
            if (event.keyCode == 8 && (length <= 1 || selection.length >= length)) {
                contenteditable.html('');
                return placeholder.text(string.placeholder)
            }
            else if (e.type == 'cut' && selection == text) return placeholder.text(string.placeholder);
            else if (length + 1) {
                placeholder.text('');
                await handlePrompt(`${text}${(event.key.length == 1) ? event.key : ''}`, contenteditable);
            }
        })

        send.click(() => {
            let content = contenteditable.text();
            if (!profile || !content.length) return;
            postRequest({
                util: role,
                data: {
                    user_id: profile.user_id,
                    tweet_id: role == 'comment' ? target.data('id') : undefined,
                    content
                }
            });
            window.location.reload();
        });

        imageBtn.click(async () => {
            imageInput.click();
            imageInput.change(async () => {
                var file_data = imageInput.prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('file', file_data);
                form_data.append('util', 'image');
                form_data.append('type', '.' + file_data.type.slice(file_data.type.indexOf('/') + 1));
                
                let response = await $.ajax({
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: (response) => response,
                    error: (response) => response
                });

                response = JSON.parse(response);
                document.execCommand('insertHtml', false, ` <a href='../images/storage/${response.id}' class="img_link">http://lo.cal/${response.id}</a> `);
                placeholder.html('');

            });
        })

        modal_pic_holder.append(profile_pic);
        modal_text.append(contenteditable, placeholder);
        body.append(modal_pic_holder, modal_text);
        footer.append(send , imageBtn);

        header.append(svg);
        container.append(header, body, footer);
        background.append(container);
        $('body').append(background);
        contenteditable.focus();

        background.click((e) => $(e.target).hasClass('modal') ? background.remove() : null);
        svg.click(() => background.remove());
    }

    comment.click((e) => {
        showModal(
            {
                target: $(e.target).parents('.tweet_container'),
                role: 'comment'
            });
    });

    tweet.click((e) => {
        showModal({ role: 'tweet' });
    });

    let _return = $('.return');
    _return.click(() => window.history.back());


    let handlePrompt = async (text, container) => {
        let split = text.split(/\s+/);
        let last = split[split.length - 1];
        document.execCommand('foreColor', false, 'black');
        $('.tweet_username_search').remove();

        if (last.startsWith('@')) {
            document.execCommand('foreColor', false, '#1DA1F2');
            let search = last.slice(1);

            if (search) {
                let searchContainer = $('<div class="tweet_username_search"></div>');
                let response = await postRequest({
                    util: 'mention',
                    data: search
                })

                response.forEach((e) => {
                    let item = $("<div class='tweet_item_search'></div");
                    item.append(`
                        <div class="tweet_item_profile">
                            <img src='${e.picture}'/> 
                        </div>
                        <div class="tweet_item_body">
                            <p class='font-weight-bold'>${e.fullname}</p>
                            <p class='text-muted'>@${e.username}</p>
                        </div>
                    `)
                    item.click(() => {
                        let fonts = $('[color="#1DA1F2"]', container);
                        fonts.each((i, el) => {
                            if ($(el).text() == last) $(el).text('@' + e.username);
                        });
                        $('.tweet_username_search').remove();
                    })

                    searchContainer.append(item);
                });

                if (searchContainer.html()) container.append(searchContainer);
            }
        } else if (last.startsWith('#')) {
            document.execCommand('foreColor', false, '#1DA1F2');
        }
    }

    let search_icon = $('.search_icon');
    search_icon.click(() => {
        if(!$('.search_form > input[name="q"]').val()) return
        else $('.search_form').submit();
    })

});