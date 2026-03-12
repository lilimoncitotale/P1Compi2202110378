func main() {
    fmt.Println("=== INICIO PRUEBA ERRORES ===")

    a := 10
    b := "hola"
    // Error semántico: suma de int + string
    c := a + b

    // Error sintáctico: falta la llave del if
    if a > 5
        fmt.Println("Falta llave en el if")

    // Error semántico: uso de variable no declarada
    undeclaredVar = 5

    // Redeclaración/conflicto: usar var después de := (dependiendo de reglas puede causar alerta)
    var a = 20

    fmt.Println("=== FIN PRUEBA ERRORES ===")
}
