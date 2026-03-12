// Qualification test input generated to match grading checklist

// Constantes
const PI float32 = 3.141592
const GRAVEDAD float32 = 9.8
const MAX_INT int32 = 32767

// Variables top-level (deben usar "var")
var entero int32 = 42
var decimal float32 = 3.14
var bandera bool = true
var caracter rune = 'A'
var texto string = "GolampiTest"

// Arrays will be tested inside functions; avoid top-level array literals to match grammar

// Funciones de prueba
func imprimirArbol() {
    println("    *")
    println("   ***")
    println("  *****")
    println("   |||")
}

func testAritmeticas() {
    a := 20
    b := 7
    print("suma:", a + b)
    print("resta:", a - b)
    print("multi:", a * b)
    print("div:", a / b)
    print("mod:", a % b)
}

func testRelacionales() {
    x := 5
    y := 8
    print(x > y)
    print(x < y)
    print(x == y)
    print(x != y)
}

func testLogicas() {
    t := true
    f := false
    print(t && f)
    print(t || f)
    print(!t)
}

func incrementoTest() {
    v := 0
    v++
    print("v after ++:", v)
    v--
    print("v after --:", v)
}

func potencia(base int32, exp int32) int32 {
    if exp == 0 {
        return 1
    }
    return base * potencia(base, exp-1)
}

func division(div int32, d int32) int32, bool {
    if d == 0 {
        return 0, false
    }
    return div / d, true
}

func intercambioValores(a *int32, b *int32) {
    temp := *a
    *a = *b
    *b = temp
}

func ordenamientoSeleccion(arr *[5]int32) {
    for i := 0; i < 4; i++ {
        minIdx := i
        for j := i+1; j < 5; j++ {
            if arr[j] < arr[minIdx] {
                minIdx = j
            }
        }
        if minIdx != i {
            intercambioValores(&arr[i], &arr[minIdx])
        }
    }
}

func testForLoops() {
    // clásico
    for i := 1; i <= 3; i++ {
        print("for classic i=", i)
    }
    // condicional (while)
    j := 1
    for j <= 3 {
        print("for cond j=", j)
        j++
    }
    // infinito con break
    k := 1
    for {
        print("for inf k=", k)
        k++
        if k > 3 {
            break
        }
    }
}

func testArraysAndPointers() {
    var a [5]int32 = [5]int32{9,8,7,6,5}
    ordenamientoSeleccion(&a)
    print("sorted:")
    for i := 0; i < 5; i++ {
        print(" ", a[i])
    }
    println("")
}

func testBuiltins() {
    s := "hola"
    println("len(s):", len(s))
    arr := [3]int32{1,2,3}
    println("len(arr):", len(arr))
    println("substr:", substr(s, 0, 2))
    println("now:", now())
    println("typeOf(123):", typeOf(123))
    println("typeOf(3.14):", typeOf(3.14))
}

func main() {
    println("=== START QUALIFICATION TEST ===")
    imprimirArbol()
    testAritmeticas()
    testRelacionales()
    testLogicas()
    incrementoTest()
    testForLoops()
    testArraysAndPointers()
    testBuiltins()

    // funciones con retorno multiple
    q, ok := division(10, 3)
    println("10/3=", q, "ok:", ok)

    p := potencia(2, 5)
    println("2^5=", p)

    println("=== END QUALIFICATION TEST ===")
}
