If your order is blocked by `B2BApi, reason=wait callback`,

since this b2b is handling job,

but not sending the fail callback to KKday,

in this situation, 

call callback manually.

```php
(new KKModel())->b2bNotifyCallBack([
    'orderMid' => '24KKXXXXX',
    'metadata' => [
        'status' => 'B999',
        'description' => 'order create failed - test',
    ],
]);
```
