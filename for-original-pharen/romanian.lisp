
; romanian

(defmacro daca (test-expr then-expr el-expr)
    '(if ~test-expr ~then-expr ~el-expr)
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
