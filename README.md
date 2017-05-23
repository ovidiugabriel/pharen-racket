# pharen-racket (Pharentheses)
A Racket to PHP compiler (using PHP Pharen Runtime)

**Note: This is a specification. It is not implemented.**

#### Differences from original "Pharen" language

##### OOP and Namespace integration

[Classes and Objects](https://docs.racket-lang.org/guide/classes.html)  in The Racket Guide introduces classes and objects.

But for now ...

Prefer using a more let's say pythonic approach here. So for an object method definiton, instead of having:

```clojure
;; Original pharen code
(class user
  (fn my-method (arg)
    "This method belongs to class 'User'"))
```

We will actually write:

```racket
;; racket code
(define (user-my-method self arg) 
    "This method belongs to class 'User'")
```

This allows the compiler to keep a consistent *functional* semantic instead of adding extra syntax for method definition.

###### Object method call

OOP and Namespace integration is different, since `::`, `->` or `.` are not supported in Racket.

This one

```clojure
;; original pharen code
(-> santa (my-method "gifts!"))
```

becomes

```racket
;; racket code
(send santa my-method "gifts")
```

###### Static method call

The static method call

```clojure
(:: Route (get "user/{name}" f))
```

becomes a simple function call

```racket
(route-get "user/{name}" f)
```

This will first try to call `route_get()` if exists, otherwise will try to call `route::get()`.


##### String concatenation

The string concatenation operator `.` is already used as cons equivalent in Racket. So `'(1 . 2)` is equivalent with `(cons 1 2)`.
For this reason the `..` operator will be used instead, which is nothing but an alias for `string-append`.

Please note that in Racket `string-append` joins the strings in the parameters list together, while `string-join` joins the elements of the string list received as the single parameter. 

A new operator `<>` may be introduced in the near future to allow both signatures. Even if we received some criticism about using operators instead of functions.
