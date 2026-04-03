import './bootstrap';

const userId = document.querySelector('meta[name="user-id"]').content;

window.Echo.channel('shared')
    .listen('CreatedNotification', (e) => {
        console.log(e.status);
    });

window.Echo.private('private-share')
    .listen('CreatedPrivateShare', (e) => {
        console.log(e.status);
    });

window.Echo.private(`App.Models.User.${userId}`)
    .listen('CreatedPrivate', (e) => {
        console.log(e.status);
    });
