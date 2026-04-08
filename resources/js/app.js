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

const echoUserChannel = `App.Models.User.${userId}`;

window.Echo.private(echoUserChannel)
    .listen('CreatedPrivate', (e) => {
        console.info('CreatedPrivate', {
            status: e.status,
            userId: e.userId,
        });
    })
    .listen('.PostCreated', (e) => {
        console.info('PostCreated', {
            postId: e.model?.id,
            model: e.model,
        });
    })
    .listen('.PostUpdated', (e) => {
        console.info('PostUpdated', {
            postId: e.model?.id,
            model: e.model,
        });
    })
    .listen('.PostSaved', (e) => {
        console.info('PostSaved', {
            postId: e.model?.id,
            model: e.model ?? e,
        });
    })
    .listen('.PostRetrieved', (e) => {
        console.info('PostRetrieved', {
            postId: e.model?.id,
            model: e.model ?? e,
        });
    })
    .listen('.PostDeleted', (e) => {
        console.info('PostDeleted', {
            postId: e.model?.id,
            model: e.model ?? e,
        });
    });


window.Echo.join(`chat.1`)
    .here((users) => {
         console.log(users);
    })
    .joining((user) => {
        console.log(user.name);
    })
    .leaving((user) => {
        console.log(user.name);
    })
    .error((error) => {
        console.error(error);
    });