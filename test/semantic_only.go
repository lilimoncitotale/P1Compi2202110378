func main() {
    fmt.Println("=== INICIO PRUEBA SEMANTICOS ===")

    a := 10
    b := "hola"
    // Error semántico: suma de int + string (tipo incompatible)
    c := a + b

    // Error semántico: uso de variable no declarada (asignación)
    undeclaredVar = 5

    // Intento de asignar float a int (si ocurre en lenguaje)
    var x int
    x = 3.14

    fmt.Println("=== FIN PRUEBA SEMANTICOS ===")
}
