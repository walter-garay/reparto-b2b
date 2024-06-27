<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" placeholder="Ingrese Monto" required><br>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="pagado">Pagado</option>
            <option value="cancelado">Cancelado</option>
        </select><br>

        <label for="metodo">Método:</label>
        <select id="metodo" name="metodo" required>
            <option value="tarjeta">Tarjeta</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
        </select><br>

        <input type="submit" name="submit" value="Guardar Pago">
    </form>

    <?php
    if(isset($_POST["submit"])) {
        $monto = $_POST["monto"];
        $estado = $_POST["estado"];
        $metodo = $_POST["metodo"];
        
        require_once '../controladores/PagoController.php';    
        $pc = new PagoController();
        $resultado = $pc->guardar($monto, $estado, $metodo);
        
        if ($resultado) {
            echo "Pago guardado exitosamente.";
        } else {
            echo "Error al guardar el pago.";
        }
    }
    ?>