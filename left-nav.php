<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <!-- <img alt="image" class="img-circle" src="img/profile_small.jpg" /> -->
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['USER_NAME']?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['USER_ROLE']?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="logout.php">Salir</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <?php if($loggdUType != "User") : ?>
                <li  <?php if(isset($userclass)) echo $userclass;?>>
                    <a href="#"><i class="fa fa-user"></i><span class="nav-label">Usuarios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerclass)) echo $registerclass;?>>
                          <a href="register.php">
                            Registro de Usuario
                          </a>
                        </li>
                        <li <?php if(isset($userlistclass)) echo $userlistclass;?>>
                          <a href="users.php">
                            Lista de Usuario
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($countryclass)) echo $countryclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">MASTERS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerCntclass)) echo $registerCntclass;?>>
                          <a href="register-country.php">
                            Registrar Pais
                          </a>
                        </li>
                        <li <?php if(isset($editCntclass)) echo $editCntclass;?>>
                          <a href="country.php">
                            Lista de paises
                          </a>
                        </li>
                        <li <?php if(isset($registerCstmclass)) echo $registerCstmclass;?>>
                          <a href="register-customer.php">
                            Registro de Cliente
                          </a>
                        </li>
                        <li <?php if(isset($editCstmclass)) echo $editCstmclass;?>>
                          <a href="customer.php">
                            Lista de Clientes
                          </a>
                        </li>
                        <li <?php if(isset($registerContclass)) echo $registerContclass;?>>
                          <a href="register-contact.php">
                            Registro de Contacto
                          </a>
                        </li>
                        <li <?php if(isset($editContclass)) echo $editContclass;?>>
                          <a href="contact.php">
                            Lista de Contacto
                          </a>
                        </li>
                        <li <?php if(isset($registerVehclass)) echo $registerVehclass;?>>
                          <a href="register-vehicle.php">
                            Registro de Vehiculo
                          </a>
                        </li>
                        <li <?php if(isset($editVehclass)) echo $editVehclass;?>>
                          <a href="vehicle.php">
                            Lista de Vehiculo
                          </a>
                        </li>
                        <li <?php if(isset($registerEmpclass)) echo $registerEmpclass;?>>
                          <a href="register-employee.php">
                            Registro de Empleado
                          </a>
                        </li>
                        <li <?php if(isset($editEmpclass)) echo $editEmpclass;?>>
                          <a href="employee.php">
                            Lista de Empleado
                          </a>
                        </li>
                        <li <?php if(isset($registerSupclass)) echo $registerSupclass;?>>
                          <a href="register-supplier.php">
                            Registro de Proveedor
                          </a>
                        </li>
                        <li <?php if(isset($editSupclass)) echo $editSupclass;?>>
                          <a href="supplier.php">
                            Lista de Proveedores
                          </a>
                        </li>
                        <li <?php if(isset($registerServclass)) echo $registerServclass;?>>
                          <a href="register-service.php">
                            Registro de Servicio
                          </a>
                        </li>
                        <li <?php if(isset($editServclass)) echo $editServclass;?>>
                          <a href="service.php">
                            Lista de Servicios
                          </a>
                        </li>
                        <li <?php if(isset($registerCompclass)) echo $registerCompclass;?>>
                          <a href="register-company.php">
                            Registro de Compañia
                          </a>
                        </li>
                        <li <?php if(isset($editCompclass)) echo $editCompclass;?>>
                          <a href="company.php">
                            Lista de Compañias
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($craneclass)) echo $craneclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">GRUAS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerJobclass)) echo $registerJobclass;?>>
                          <a href="register-job.php">
                            Registrar Trabajo
                          </a>
                        </li>
                        <li <?php if(isset($editJobclass)) echo $editJobclass;?>>
                          <a href="jobs.php">
                            Lista de Trabajo
                          </a>
                        </li>
                        <li <?php if(isset($resourceCalandarclass)) echo $resourceCalandarclass;?>>
                          <a href="resource-calandar.php">
                            Calendario de Recursos
                          </a>
                        </li>
                        <li <?php if(isset($serviceAggclass)) echo $serviceAggclass;?>>
                          <a href="service-agreement.php">
                            Acuerdo de Servicios
                          </a>
                        </li>
                        <li <?php if(isset($Termsclass)) echo $Termsclass;?>>
                          <a href="term-condition.php">
                            Terminos y Condiciones
                          </a>
                        </li>
                        <li <?php if(isset($ProposalNoteclass)) echo $ProposalNoteclass;?>>
                          <a href="proposal-note.php">
                            Nota de Propuesta
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($fleetclass)) echo $fleetclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">FLOTA</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerFuelclass)) echo $registerFuelclass;?>>
                          <a href="register-fuel.php">
                            Registrar Entrada de Combustible
                          </a>
                        </li>
                        <li <?php if(isset($editFuelclass)) echo $editFuelclass;?>>
                          <a href="fuel.php">
                            Lista de Combustible
                          </a>
                        </li>
                        <li <?php if(isset($registerWorkOrderclass)) echo $registerWorkOrderclass;?>>
                          <a href="register-workorder.php">
                            Registrar Orden de Trabajo
                          </a>
                        </li>
                        <li <?php if(isset($editWorkOrderclass)) echo $editWorkOrderclass;?>>
                          <a href="workorder.php">
                            Lista de Orden de trabajo
                          </a>
                        </li>
                        <li <?php if(isset($registerFleetIssueclass)) echo $registerFleetIssueclass;?>>
                          <a href="register-fleet-issue.php">
                            Registrar Flota Issue
                          </a>
                        </li>
                        <li <?php if(isset($editFleetIssueclass)) echo $editFleetIssueclass;?>>
                          <a href="fleetissue.php">
                            Lista de Flota Issue
                          </a>
                        </li>
                        <li <?php if(isset($registerServRemindclass)) echo $registerServRemindclass;?>>
                          <a href="register-service-reminder.php">
                            Registro Recordatorio de Servicios
                          </a>
                        </li>
                        <li <?php if(isset($editServRemindclass)) echo $editServRemindclass;?>>
                          <a href="servicereminder.php">
                            Registro de Recordatorio de Servicios
                          </a>
                        </li>
                        <li <?php if(isset($registerRenewRemindclass)) echo $registerRenewRemindclass;?>>
                          <a href="register-renewal-reminder.php">
                            Registro de Recordatorio de renovación
                          </a>
                        </li>
                        <li <?php if(isset($editRenewRemindclass)) echo $editRenewRemindclass;?>>
                          <a href="renewalreminder.php">
                            Lista de Recordatorio de renovación
                          </a>
                        </li>
                        <li <?php if(isset($registerCommentclass)) echo $registerCommentclass;?>>
                          <a href="register-comment.php">
                            Registro de Comentario
                          </a>
                        </li>
                        <li <?php if(isset($editCommentclass)) echo $editCommentclass;?>>
                          <a href="comment.php">
                            Lista de Comentarios
                          </a>
                        </li>
                        <li <?php if(isset($registerDocumentclass)) echo $registerDocumentclass;?>>
                          <a href="register-document.php">
                            Registro de Documento
                          </a>
                        </li>
                        <li <?php if(isset($editDocumentclass)) echo $editDocumentclass;?>>
                          <a href="documents.php">
                            Lista de Documentos
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($inventoryclass)) echo $inventoryclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">INVENTARIO</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerInvLocclass)) echo $registerInvLocclass;?>>
                          <a href="register-location.php">
                            Registro de Localidad
                          </a>
                        </li>
                        <li <?php if(isset($editInvLocclass)) echo $editInvLocclass;?>>
                          <a href="locations.php">
                            Lista de Localidades
                          </a>
                        </li>
                        <li <?php if(isset($registerItemTypeclass)) echo $registerItemTypeclass;?>>
                          <a href="register-item-type.php">
                            Registro de tipo de Items
                          </a>
                        </li>
                        <li <?php if(isset($edititemTypeclass)) echo $edititemTypeclass;?>>
                          <a href="itemtype.php">
                            Lista de tipo de Items
                          </a>
                        </li>
                        <li <?php if(isset($registerItemclass)) echo $registerItemclass;?>>
                          <a href="register-item.php">
                            Registro de Items
                          </a>
                        </li>
                        <li <?php if(isset($edititemclass)) echo $edititemclass;?>>
                          <a href="items.php">
                            Lista de Items
                          </a>
                        </li>
                        <li <?php if(isset($registerInvAdjustclass)) echo $registerInvAdjustclass;?>>
                          <a href="inventory-adjust.php">
                            Ajuste de Inventario
                          </a>
                        </li>
                        <li <?php if(isset($listAjustclass)) echo $listAjustclass;?>>
                          <a href="list_inventory-adjust.php">
                            Lista de Ajuste de Inventario
                          </a>
                        </li>
                        <li <?php if(isset($registerStockTransclass)) echo $registerStockTransclass;?>>
                          <a href="stock-transfer.php">
                            Transferencia de stock
                          </a>
                        </li>
                        <li <?php if(isset($registerPOclass)) echo $registerPOclass;?>>
                          <a href="register-po.php">
                            Registro de Orden de compra
                          </a>
                        </li>
                        <li <?php if(isset($editPOclass)) echo $editPOclass;?>>
                          <a href="purchaseorder.php">
                            Lista de Orden de compra
                          </a>
                        </li>
                        <li <?php if(isset($registerRecvStockclass)) echo $registerRecvStockclass;?>>
                          <a href="register-receive-stock.php">
                            Orden Recibida
                          </a>
                        </li>
                        <li <?php if(isset($editRecvStockclass)) echo $editRecvStockclass;?>>
                          <a href="received-stock.php">
                            Lista de Recibido Stock
                          </a>
                        </li>
                        <li <?php if(isset($registerReqsclass)) echo $registerReqsclass;?>>
                          <a href="register-requisition.php">
                            Material Requisicion
                          </a>
                        </li>
                        <li <?php if(isset($editReqsclass)) echo $editReqsclass;?>>
                          <a href="requisition.php">
                            Lista de Requisicion
                          </a>
                        </li>
                    </ul>
                </li>

                <li  <?php if(isset($reportclass)) echo $reportclass;?>>
                    <a href="#"><i class="fa fa-file-pdf-o"></i><span class="nav-label">Reportes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php if(isset($reporviewclass)) echo $reporviewclass;?>>
                          <a href="report_1.php">
                            Pre-Orden de Trabajo
                          </a>
                        </li>
                        <li <?php if(isset($editPreWorkOrderclass)) echo $editPreWorkOrderclass;?>>
                          <a href="report_2.php">
                            Orden de Trabajo
                          </a>
                        </li>
                        <li <?php if(isset($reportitemclass)) echo $reportitemclass;?>>
                          <a href="report_items.php">
                            Lista de Items
                          </a>
                        </li>
                        <li <?php if(isset($reportinvclass)) echo $reportinvclass;?>>
                          <a href="reporte_inventario.php">
                            Inventario
                          </a>
                        </li>
                    </ul>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </nav>
