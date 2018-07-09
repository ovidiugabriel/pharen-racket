
; romanian

(defmacro daca (test-expr then-expr else-expr)
    '(if ~test-expr ~then-expr ~else-expr)
)

(defmacro cand (test-expr body)
    '(when ~test-expr ~body)
)

(defmacro executa (&args)
    '(do ~@args)    
)

; unless
(defmacro cand-nu (test-expr body)
    '(when (not ~test-expr) ~body)
)
