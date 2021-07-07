$(document).ready(() => {
    let follow_btn = $('.follow_btn');
    let followers_count = $('.followers');

    let current = window.location.href;
    let baseUrl = current.slice(0, current.lastIndexOf('/'));
    let url = baseUrl + '/controllers/ajaxFollow.php';

    console.log(url);

    follow_btn.click(async () => {
        let response = await $.ajax({
            url: url,
            method: 'POST',
            data: {
                username: $('.username').text().slice(1),
            },
            sucess: (response) => response
        })

        //ERROR -1 FOLLOWER
        response = JSON.parse(response);
        console.log(response);
        if(response.following) {
            follow_btn.removeClass('button-outline-light').addClass('button-light');
            follow_btn.text('Abonné');
            let text = followers_count.text();
            text++;
            followers_count.text(text);

        } else {
            follow_btn.addClass('button-outline-light').removeClass('button-light');
            follow_btn.text('Suivre');
            let text = followers_count.text();
            text--;
            followers_count.text(text);
        }

    })
});