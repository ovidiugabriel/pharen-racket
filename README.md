# pharen-racket
A Racket to PHP compiler (using PHP Pharen Runtime)

#### Differences from original "Pharen" language

##### OOP and Namespace integration

Prefer using a more let's say pythonic approach here. So instead of having:

```clojure
(class User
  (fn my-method (arg)
    "This method belongs to class 'User'"))
```

We will actually write:

```racket
(define (User::my-method self arg) 
    "This method belongs to class 'User'")
```

This allows the compiler to keep a consistent *functional* semantic instead of adding extra syntax for method definition.

OOP and Namespace integration is different, since `::` and `->` are not supported in Racket.

This one

```clojure
(-> santa (my-method "gifts!"))
```

becomes

```racket
(User::my-method santa "gifts")
```


##### String concatenation

The string concatenation operator `.` is already used as cons equivalent in Racket. So `'(1 . 2)` is equivalent with `(cons 1 2)`.
For this reason the `..` operator will be used instead, which is nothing but an alias for `string-append`.

Please note that in Racket `string-append` joins the strings in the parameters list together, while `string-join` joins the elements of the string list received as the single parameter. A new operator `<>` may be introduced in the near future to allow both signatures. See http://reference.wolfram.com/language/ref/StringJoin.html for more info.
