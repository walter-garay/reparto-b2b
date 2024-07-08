<?php
require_once "../layouts/header.php";
require_once "../controladores/DeliveryControlador.php";

$dc = new DeliveryControlador();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $deliveryDetallado = $dc->obtenerDeliveryDetalladoPorId($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'id' => $_POST['id'],
        'id_cliente' => 1,
        'descripcion' => $_POST['descripcion'],

        'direccion_recojo' => $_POST['direccion_recojo'],
        'fecha_recojo' => $_POST['fecha_recojo'],
        'hora_recojo' => $_POST['hora_recojo'],

        'direccion_entrega' => $_POST['direccion_entrega'],
        'fecha_entrega' => $_POST['fecha_entrega'],
        'hora_entrega' => $_POST['hora_entrega'],

        'dni_destinatario' => $_POST['dni_destinatario'],
        'nombres_destinatario' => $_POST['nombres_destinatario'],
        'apellidos_destinatario' => $_POST['apellidos_destinatario'],
        'celular_destinatario' => $_POST['celular_destinatario'],

        'monto_pago' => $_POST['monto_pago'],
        'metodo_pago' => $_POST['metodo_pago'],

        'costo_delivery' => $_POST['costo_delivery'],
        'costo_pedido' => $_POST['costo_pedido']
    ];

    // $dc->actualizarDelivery($datos);

    header("Location: index.php");
    exit;
}
?>

<div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
    <div class="container m-10 rounded-4 shadow-sm col-lg-6 col-md-12 p-4" style="background-color: white;">
        <div class="d-flex justify-content-between ">
            <h2 class="mb-4 fs-5 ">Solicitud de delivery</h2>
            <a href=".">
                <i class="bi bi-x-lg text-black fs-5 d-flex"></i>
            </a>
        </div>
        <form method="POST" action="" id="stepForm">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="true">Descripción</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false">Recojo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false">Entrega</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step4-tab" data-bs-toggle="tab" data-bs-target="#step4" type="button" role="tab" aria-controls="step4" aria-selected="false">Destinatario</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step5-tab" data-bs-toggle="tab" data-bs-target="#step5" type="button" role="tab" aria-controls="step5" aria-selected="false">Pago</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <div class="mb-3">
                        <label for="descripcion">Qué contiene el paquete (pedido)</label>
                        <input value="<?= $deliveryDetallado['delivery']->getDescripcion() ?>" type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <?php
                            $costo_delivery = $deliveryDetallado['contraentrega']->getCostoDelivery();
                            $costo_pedido = $deliveryDetallado['contraentrega']->getCostoPedido();
                        ?>
                        
                        <label for="descripcion">¿Debemos cobrar al destinatario?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="contraentrega" id="no_cobrar" value="no_cobrar" <?= ($costo_delivery == 0 && $costo_pedido == 0) ? 'checked' : ''; ?> >
                            <label class="form-check-label text-secondary" for="no_cobrar">No cobrar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="contraentrega" id="solo_pedido" value="solo_pedido" <?= ($costo_pedido > 0 && ($costo_delivery == 0 || $costo_delivery === null)) ? 'checked' : ''; ?> >
                            <label class="form-check-label text-secondary" for="solo_pedido">Solo valor del pedido</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="contraentrega" id="solo_delivery" value="solo_delivery" <?= ($costo_delivery > 0 && ($costo_pedido == 0 || $costo_pedido === null)) ? 'checked' : ''; ?> >
                            <label class="form-check-label text-secondary" for="solo_delivery">Solo delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="contraentrega" id="cobrar_ambos" value="cobrar_ambos" <?= ($costo_delivery > 0 && $costo_pedido > 0) ? 'checked' : ''; ?> >
                            <label class="form-check-label text-secondary" for="cobrar_ambos">Cobrar ambos</label>
                        </div>
                    </div>
                    <div class="mb-3 contraentrega-fields">
                        <label for="costo_delivery">¿Cuánto debemos cobrarle por el delivery?</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input value="<?= $deliveryDetallado['contraentrega']->getCostoDelivery() ?>" type="number" step="0.1" placeholder="0.00" class="form-control" id="costo_delivery" name="costo_delivery" required>
                        </div>
                    </div>
                    <div class="mb-3 contraentrega-fields">
                        <label for="costo_pedido">¿Cuánto debemos cobrarle por el pedido?</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input value="<?= $deliveryDetallado['contraentrega']->getCostoPedido() ?>" type="number" step="0.1" placeholder="0.00" class="form-control" id="costo_pedido" name="costo_pedido" required >
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary next-step">Siguiente</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <div class="mb-3">
                        <label for="direccion_recojo">Dónde lo recogemos</label>
                        <input value="<?= $deliveryDetallado['recojo']->getDireccion() ?>" type="text" class="form-control" id="direccion_recojo" name="direccion_recojo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_recojo">Cuándo lo recogemos</label>
                        <input value="<?= $deliveryDetallado['recojo']->getFecha() ?>" type="date" class="form-control" id="fecha_recojo" name="fecha_recojo" >
                    </div>
                    <div class="mb-3">
                        <label for="hora_recojo">A qué hora lo recogemos (considere 5min de retraso)</label>
                        <input value="<?= $deliveryDetallado['recojo']->getHora() ?>" type="time" class="form-control" id="hora_recojo" name="hora_recojo">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary prev-step me-2">Anterior</button>
                        <button type="button" class="btn btn-outline-primary next-step">Siguiente</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                    <div class="mb-3">
                        <label for="direccion_entrega">Dirección (Huánuco)</label>
                        <input value="<?= $deliveryDetallado['entrega']->getDireccion() ?>" type="text" class="form-control" id="direccion_entrega" name="direccion_entrega" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega">Fecha</label>
                        <input value="<?= $deliveryDetallado['entrega']->getFecha() ?>" type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
                    </div>
                    <div class="mb-3">
                        <label for="hora_entrega">Hora</label>
                        <input value="<?= $deliveryDetallado['entrega']->getHora() ?>" type="time" class="form-control" id="hora_entrega" name="hora_entrega">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary prev-step me-2">Anterior</button>
                        <button type="button" class="btn btn-outline-primary next-step">Siguiente</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                    <div class="mb-3">
                        <label for="dni_destinatario">DNI</label>
                        <input value="<?= $deliveryDetallado['destinatario']->getDni() ?>" type="text" class="form-control" id="dni_destinatario" name="dni_destinatario">
                    </div>
                    <div class="mb-3">
                        <label for="nombres_destinatario">Nombres</label>
                        <input value="<?= $deliveryDetallado['destinatario']->getNombres() ?>" type="text" class="form-control" id="nombres_destinatario" name="nombres_destinatario">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos_destinatario">Apellidos</label>
                        <input value="<?= $deliveryDetallado['destinatario']->getApellidos() ?>" type="text" class="form-control" id="apellidos_destinatario" name="apellidos_destinatario">
                    </div>
                    <div class="mb-3">
                        <label for="celular_destinatario">Celular</label>
                        <input value="<?= $deliveryDetallado['destinatario']->getCelular() ?>" type="tel" class="form-control" id="celular_destinatario" name="celular_destinatario" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary prev-step me-2">Anterior</button>
                        <button type="button" class="btn btn-outline-primary next-step">Siguiente</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="step5" role="tabpanel" aria-labelledby="step5-tab">
                    <div class="mb-3">
                        <label for="monto_pago">Costo del delivery</label>
                        <input value="<?php echo $deliveryDetallado['pago']->getMonto(); ?>" type="text" class="form-control" id="monto_pago" name="monto_pago">
                    </div>
                    <div class="mb-3">
                        
                        <label for="metodo_pago">Método de pago</label>
                        <?php $metodo_pago = $deliveryDetallado['pago']->getMetodo(); ?>
                        <select name="metodo_pago"  class="form-select" aria-label="Seleccionar tu método de pago preferido">
                            <option value="Yape / Plin" <?= $metodo_pago == "Yape / Plin" ? 'selected' : ''; ?>>Yape / Plin</option>
                            <option value="BCP" <?= $metodo_pago == "BCP" ? 'selected' : ''; ?>>Transferencia (BCP)</option>
                            <option value="Interbank" <?= $metodo_pago == "Interbank" ? 'selected' : ''; ?>>Transferencia (Interbank)</option>
                            <option value="BBVA" <?= $metodo_pago == "BBVA" ? 'selected' : ''; ?>>Transferencia (BBVA)</option>
                            <option value="Paypal" <?= $metodo_pago == "Paypal" ? 'selected' : ''; ?>>Paypal</option>
                        </select>                
                    </div>
                    <p class="text-sm text-secondary">Una vez envíes tu solicitud, nuestro equipo se pondrá en contacto para coordinar el pago.</p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary prev-step me-2">Anterior</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
require_once "../layouts/footer.php";
?>


<style>
.nav-link.completed {
    color: #55C800 !important;
}
</style>

<!-- Funcionalidad para el formulario en pasos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('stepForm');
        const contraentregaFields = document.querySelectorAll('.contraentrega-fields');
        const costoDelivery = document.getElementById('costo_delivery');
        const costoPedido = document.getElementById('costo_pedido');

        function showFields(option) {
            contraentregaFields.forEach(field => field.style.display = 'none');

            if (option === 'solo_pedido' || option === 'cobrar_ambos') {
                costoPedido.parentNode.parentNode.style.display = 'block';
            }
            if (option === 'solo_delivery' || option === 'cobrar_ambos') {
                costoDelivery.parentNode.parentNode.style.display = 'block';
            }
            // if (option === 'no_cobrar') {
            //     costoDelivery.value = costoPedido.value = '0';
            // }
        }

        document.querySelectorAll('input[name="contraentrega"]').forEach(radio => {
            radio.addEventListener('change', () => showFields(radio.value));
        });

        const selectedOption = document.querySelector('input[name="contraentrega"]:checked');
        if (selectedOption) {
            showFields(selectedOption.value);
        }

        function validateStep(tab) {
            const inputs = tab.querySelectorAll('input[required]');
            return Array.from(inputs).every(input => {
                const isValid = input.value.trim() !== '';
                input.classList.toggle('is-invalid', !isValid);
                const feedback = input.nextElementSibling;
                if (!isValid && (!feedback || !feedback.classList.contains('invalid-feedback'))) {
                    const newFeedback = document.createElement('div');
                    newFeedback.className = 'invalid-feedback';
                    newFeedback.textContent = 'Este campo es requerido.';
                    input.parentNode.insertBefore(newFeedback, input.nextSibling);
                } else if (isValid && feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
                return isValid;
            });
        }

        function updateTabStatus(tab, isValid) {
            const tabButton = document.querySelector(`[data-bs-target="#${tab.id}"]`);
            tabButton.classList.toggle('completed', isValid);
        }

        function handleTabChange(direction) {
            const currentTab = document.querySelector('.tab-pane.active');
            const currentTabButton = document.querySelector(`[data-bs-target="#${currentTab.id}"]`);
            
            if (direction === 'next') {
                if (!validateStep(currentTab)) return;
                currentTabButton.classList.add('completed');
            } else {
                currentTabButton.classList.remove('completed');
            }

            const targetTab = direction === 'next' ? currentTab.nextElementSibling : currentTab.previousElementSibling;
            new bootstrap.Tab(document.querySelector(`[data-bs-target="#${targetTab.id}"]`)).show();
        }

        document.querySelectorAll('.next-step').forEach(btn => btn.addEventListener('click', () => handleTabChange('next')));
        document.querySelectorAll('.prev-step').forEach(btn => btn.addEventListener('click', () => handleTabChange('prev')));

        form.querySelectorAll('input[required]').forEach(input => {
            input.addEventListener('input', () => {
                const tab = input.closest('.tab-pane');
                const isValid = validateStep(tab);
                if (!isValid) {
                    const tabButton = document.querySelector(`[data-bs-target="#${tab.id}"]`);
                    tabButton.classList.remove('completed');
                }
            });
        });

        form.addEventListener('submit', (e) => {
            const allTabs = document.querySelectorAll('.tab-pane');
            const isValid = Array.from(allTabs).every(tab => {
                const valid = validateStep(tab);
                updateTabStatus(tab, valid);
                document.querySelector(`[data-bs-target="#${tab.id}"]`).classList.toggle('text-danger', !valid);
                return valid;
            });

            if (!isValid) {
                e.preventDefault();
                const firstInvalidTab = document.querySelector('.tab-pane:has(.is-invalid)');
                if (firstInvalidTab) {
                    new bootstrap.Tab(document.querySelector(`[data-bs-target="#${firstInvalidTab.id}"]`)).show();
                }
            }
        });
    });
</script>


