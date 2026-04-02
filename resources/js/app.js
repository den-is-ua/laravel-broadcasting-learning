import './bootstrap';

window.Echo.channel('shared')
    .listen('CreatedNotification', (e) => {
        console.log(e.status);
    });
