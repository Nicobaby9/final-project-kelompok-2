import BusEvent from './components/bus'

// Echo.join('chat-channel')
//     .here((users) => {
//         BusEvent.$emit('chat.here', users)
//     })
//     .joining((user) => {
//         BusEvent.$emit('chat.joining', user)
//     })
//     .leaving((user) => {
//         BusEvent.$emit('chat.leaving', user)
//     })
//     .listen('ChatStoredEvent', (e) => {
//         BusEvent.$emit('chat.sent', e.data);
//     });
Echo.join('chat-channel').listen('ChatStoredEvent', (e) => {
    BusEvent.$emit('chat.sent', e.data);
});

// Echo.join('update-stock').listen('StockUpdate', (e) => {
//     BusEvent.$emit('stock-update', e.data);
// });
