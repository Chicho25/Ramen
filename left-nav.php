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
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <?php if($loggdUType != "User") : ?>
                <li  <?php if(isset($userclass)) echo $userclass;?>>
                    <a href="#"><i class="fa fa-user"></i><span class="nav-label">Users</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerclass)) echo $registerclass;?>>
                          <a href="register.php">
                            Register User
                          </a>
                        </li>
                        <li <?php if(isset($userlistclass)) echo $userlistclass;?>>
                          <a href="users.php">
                            User List
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($countryclass)) echo $countryclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">MASTERS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerCntclass)) echo $registerCntclass;?>>
                          <a href="register-country.php">
                            Register Country
                          </a>
                        </li>
                        <li <?php if(isset($editCntclass)) echo $editCntclass;?>>
                          <a href="country.php">
                            Country List
                          </a>
                        </li>
                        <li <?php if(isset($registerCstmclass)) echo $registerCstmclass;?>>
                          <a href="register-customer.php">
                            Register Customer
                          </a>
                        </li>
                        <li <?php if(isset($editCstmclass)) echo $editCstmclass;?>>
                          <a href="customer.php">
                            Customer List
                          </a>
                        </li>
                        <li <?php if(isset($registerContclass)) echo $registerContclass;?>>
                          <a href="register-contact.php">
                            Register Contact
                          </a>
                        </li>
                        <li <?php if(isset($editContclass)) echo $editContclass;?>>
                          <a href="contact.php">
                            Contact List
                          </a>
                        </li>
                        <li <?php if(isset($registerVehclass)) echo $registerVehclass;?>>
                          <a href="register-vehicle.php">
                            Register Vehicle
                          </a>
                        </li>
                        <li <?php if(isset($editVehclass)) echo $editVehclass;?>>
                          <a href="vehicle.php">
                            Vehicle List
                          </a>
                        </li>
                        <li <?php if(isset($registerEmpclass)) echo $registerEmpclass;?>>
                          <a href="register-employee.php">
                            Register Employee
                          </a>
                        </li>
                        <li <?php if(isset($editEmpclass)) echo $editEmpclass;?>>
                          <a href="employee.php">
                            Employee List
                          </a>
                        </li>
                        <li <?php if(isset($registerSupclass)) echo $registerSupclass;?>>
                          <a href="register-supplier.php">
                            Register Supplier
                          </a>
                        </li>
                        <li <?php if(isset($editSupclass)) echo $editSupclass;?>>
                          <a href="supplier.php">
                            Supplier List
                          </a>
                        </li>
                        <li <?php if(isset($registerServclass)) echo $registerServclass;?>>
                          <a href="register-service.php">
                            Register Service
                          </a>
                        </li>
                        <li <?php if(isset($editServclass)) echo $editServclass;?>>
                          <a href="service.php">
                            Service List
                          </a>
                        </li>
                        <li <?php if(isset($registerCompclass)) echo $registerCompclass;?>>
                          <a href="register-company.php">
                            Register Company
                          </a>
                        </li>
                        <li <?php if(isset($editCompclass)) echo $editCompclass;?>>
                          <a href="company.php">
                            Company List
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($craneclass)) echo $craneclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">CRANE</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerJobclass)) echo $registerJobclass;?>>
                          <a href="register-job.php">
                            Register Job
                          </a>
                        </li>
                        <li <?php if(isset($editJobclass)) echo $editJobclass;?>>
                          <a href="jobs.php">
                            Job List
                          </a>
                        </li>
                        <li <?php if(isset($resourceCalandarclass)) echo $resourceCalandarclass;?>>
                          <a href="resource-calandar.php">
                            Resource Calandar
                          </a>
                        </li>
                        <li <?php if(isset($serviceAggclass)) echo $serviceAggclass;?>>
                          <a href="service-agreement.php">
                            Service Agreement
                          </a>
                        </li>
                        <li <?php if(isset($Termsclass)) echo $Termsclass;?>>
                          <a href="term-condition.php">
                            Terms and Conditions
                          </a>
                        </li>
                        <li <?php if(isset($ProposalNoteclass)) echo $ProposalNoteclass;?>>
                          <a href="proposal-note.php">
                            Proposal Note
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($fleetclass)) echo $fleetclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">FLEET</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerFuelclass)) echo $registerFuelclass;?>>
                          <a href="register-fuel.php">
                            Register Fuel Entry
                          </a>
                        </li>
                        <li <?php if(isset($editFuelclass)) echo $editFuelclass;?>>
                          <a href="fuel.php">
                            Fuel List
                          </a>
                        </li>
                        <li <?php if(isset($registerWorkOrderclass)) echo $registerWorkOrderclass;?>>
                          <a href="register-workorder.php">
                            Register Work Order
                          </a>
                        </li>
                        <li <?php if(isset($editWorkOrderclass)) echo $editWorkOrderclass;?>>
                          <a href="workorder.php">
                            Work Order List
                          </a>
                        </li>
                        <li <?php if(isset($registerFleetIssueclass)) echo $registerFleetIssueclass;?>>
                          <a href="register-fleet-issue.php">
                            Register Fleet Issue
                          </a>
                        </li>
                        <li <?php if(isset($editFleetIssueclass)) echo $editFleetIssueclass;?>>
                          <a href="fleetissue.php">
                            Fleet Issue List
                          </a>
                        </li>
                        <li <?php if(isset($registerServRemindclass)) echo $registerServRemindclass;?>>
                          <a href="register-service-reminder.php">
                            Register Service Reminder
                          </a>
                        </li>
                        <li <?php if(isset($editServRemindclass)) echo $editServRemindclass;?>>
                          <a href="servicereminder.php">
                            Service Reminder List
                          </a>
                        </li>
                        <li <?php if(isset($registerRenewRemindclass)) echo $registerRenewRemindclass;?>>
                          <a href="register-renewal-reminder.php">
                            Register Renewal Reminder
                          </a>
                        </li>
                        <li <?php if(isset($editRenewRemindclass)) echo $editRenewRemindclass;?>>
                          <a href="renewalreminder.php">
                            Renewal Reminder List
                          </a>
                        </li>
                        <li <?php if(isset($registerCommentclass)) echo $registerCommentclass;?>>
                          <a href="register-comment.php">
                            Register Comment
                          </a>
                        </li>
                        <li <?php if(isset($editCommentclass)) echo $editCommentclass;?>>
                          <a href="comment.php">
                            Comment List
                          </a>
                        </li>
                        <li <?php if(isset($registerDocumentclass)) echo $registerDocumentclass;?>>
                          <a href="register-document.php">
                            Register Document
                          </a>
                        </li>
                        <li <?php if(isset($editDocumentclass)) echo $editDocumentclass;?>>
                          <a href="documents.php">
                            Document List
                          </a>
                        </li>
                    </ul>
                </li>
                <li  <?php if(isset($inventoryclass)) echo $inventoryclass;?>>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">INVENTORY</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php if(isset($registerInvLocclass)) echo $registerInvLocclass;?>>
                          <a href="register-location.php">
                            Register Location
                          </a>
                        </li>
                        <li <?php if(isset($editInvLocclass)) echo $editInvLocclass;?>>
                          <a href="locations.php">
                            Location List
                          </a>
                        </li>
                        <li <?php if(isset($registerItemTypeclass)) echo $registerItemTypeclass;?>>
                          <a href="register-item-type.php">
                            Register Item Type
                          </a>
                        </li>
                        <li <?php if(isset($edititemTypeclass)) echo $edititemTypeclass;?>>
                          <a href="itemtype.php">
                            Item Type List
                          </a>
                        </li>
                        <li <?php if(isset($registerItemclass)) echo $registerItemclass;?>>
                          <a href="register-item.php">
                            Register Item
                          </a>
                        </li>
                        <li <?php if(isset($edititemclass)) echo $edititemclass;?>>
                          <a href="items.php">
                            Item List
                          </a>
                        </li>
                        <li <?php if(isset($registerInvAdjustclass)) echo $registerInvAdjustclass;?>>
                          <a href="inventory-adjust.php">
                            Inventory Adjustment
                          </a>
                        </li>
                        <li <?php if(isset($registerStockTransclass)) echo $registerStockTransclass;?>>
                          <a href="stock-transfer.php">
                            Stock Transfer
                          </a>
                        </li>
                        <li <?php if(isset($registerPOclass)) echo $registerPOclass;?>>
                          <a href="register-po.php">
                            Register Purchase Order
                          </a>
                        </li>
                        <li <?php if(isset($editPOclass)) echo $editPOclass;?>>
                          <a href="purchaseorder.php">
                            Purchse Order List
                          </a>
                        </li>
                        <li <?php if(isset($registerRecvStockclass)) echo $registerRecvStockclass;?>>
                          <a href="register-receive-stock.php">
                            Receive Order
                          </a>
                        </li>
                        <li <?php if(isset($editRecvStockclass)) echo $editRecvStockclass;?>>
                          <a href="received-stock.php">
                            Received Stock List
                          </a>
                        </li>
                        <li <?php if(isset($registerReqsclass)) echo $registerReqsclass;?>>
                          <a href="register-requisition.php">
                            Material Requisition
                          </a>
                        </li>
                        <li <?php if(isset($editReqsclass)) echo $editReqsclass;?>>
                          <a href="requisition.php">
                            Requisition List
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
                    </ul>
                </li>

                <?php endif;?>
            </ul>

        </div>
    </nav>
