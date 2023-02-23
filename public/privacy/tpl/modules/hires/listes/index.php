   <div ng-controller="ListesCtrl" ng-init="load();">
 

  <div class="bg-light lter b-b wrapper-md"   >
    <div>
      


      <h4>Liste des candidats par concours</h4>
      <ul class="breadcrumb bg-white b-a">
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.categorie" > Gestion des catégories</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.type" > Gestion des sous catégories</a></li>
        <li><a ui-sref="app.hires"> Gestion des concours</a></li>
        <li class="active">Liste des candidats</li>
      </ul>

      

    <div class="wrapper-md bg-light dk b-b text-b">
 
		  <h2 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h2>       
		  <h4 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h4>      
		  <h4 class="m-n font-thin">Code : {{hireEdit.hire_code}} </h4>      
		  <h4 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date |  date:'dd-MM-yyyy' }}</h4> 
		  <h4 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h4> 
		  <hr />
		  <h5 dir="rtl" class="alert alert-danger font-bold" ng-if="candidatsPostuled.length == null || candidatsPostuled.length == 0">لا يوجد اي مترشح لهدا المنصب </h5>
	</div>

 </div>

   
   <div class="wrapper-md" >

       

    <div class="panel panel-default">
     
 

       <div class="table-responsive" >
  

 		<table class="table table-striped" ng-if="candidatsPostuled.length != null && candidatsPostuled.length != 0">
 			<tr>
 				<th>Nom</th>
 				<th><i class="fa fa-file-pdf-o"></i> PDF</th>
 				<th><i class="fa fa-file-excel-o"></i> Excel</th>
 			</tr>
			<tr>
 				<th>Exporter la liste des jurys</th>
 				<td>
 					----
 				</td>
 				<td>
 				 
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"   ng-click="exportJury();" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				 
 				</td>
 			</tr>
 			<tr>
 				<th>Exporter la liste des candidats postulés</th>
 				<td>
  						
  					 <form method="POST" action="tpl/acceptedList.php" target="_blank">
						    <input type="hidden" name="hidden" value="{{candidatsPostuled}}" />
						    <input type="hidden" name="hiddenUser" value="{{user}}" />
						    <input type="hidden" name="typeHidden" value="postuled" />
						    <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
						    <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
						    <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportPostuled}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						    <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
					 
						    <button type="submit" name="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportPostuled || paramsDroit.ctl_all )) "  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer la liste des postulés</button>
					  </form>    

 				</td>
 				<td>
 				 
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportPostuled || paramsDroit.ctl_all ))"   ng-click="export(2);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportPostuled || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-2.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				 
 				</td>
 			</tr>


 			<tr>
 				<th>Exporter la liste des convoqués    </th>
 				<td>

  						
  					 <form method="POST" action="tpl/acceptedList.php" target="_blank">
						    <input type="hidden" name="hidden" value="{{candidatsAccepted}}" />
						    <input type="hidden" name="typeHidden" value="accepted" />
						    <input type="hidden" name="hiddenUser" value="{{user}}" />
						    <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
						    <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
						    <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportEcrit}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						    <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
						    <button type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))" name="submit"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer la liste des convoqués</button>
					  </form>    

 				</td>
 				<td>
 					<button  ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"   ng-click="export(1);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a  ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-1.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>
        
        	<tr>
 				<th>Exporter la liste des rejetés  </th>
                <td>-----</td>
 				<td>
 					<button  ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"   ng-click="export(8);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-8.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>


 			<tr>
 				<th>Exporter la liste des candidats après l'épreuve écrite (ou l'étude du dossier PA) par ordre de mérite    </th>
 				<td>

  						
  					<form method="POST" action="tpl/listEcritOrder.php" target="_blank">

		                <input type="hidden" name="hidden" value="{{candidatsEcritOrdre}}" />
		                <input type="hidden" name="typeHidden" value="ecritOrdre" />
		                <input type="hidden" name="hiddenUser" value="{{user}}" />
		                <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
		                <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportEcrit}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						    <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
		                <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
		                <button type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))" name="submit"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer la liste des écrits par ordre de mérite</button>
		            </form>



 				</td>

 				<td>
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"   ng-click="exportOral(3);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportEcrit || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-3.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>


 			<tr>
 				<th>Exporter la liste des candidats convoqués à l'oral par ordre de mérite    </th>
 				<td>

  						
  					<form method="POST" action="tpl/listEcritOrder.php" target="_blank">

		                <input type="hidden" name="hidden" value="{{candidatsAuthorize}}" />
		                <input type="hidden" name="typeHidden" value="selectToOrauxOrdre" />
		                <input type="hidden" name="hiddenUser" value="{{user}}" />
		                <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
		                <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportOral}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						    <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
		                <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
		                <button type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))" name="submit"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer les candidats convoqués à l'oral par ordre de mérite</button>
		            </form>



 				</td>

 				<td>
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))"   ng-click="exportOral(4);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-4.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>


 			<tr>
 				<th>Exporter la liste des oraux par ordre de mérite    </th>
 				<td>
  						
  					<form method="POST" action="tpl/listOralOrder.php" target="_blank">

		                <input type="hidden" name="hidden" value="{{candidatsOralOrder}}" />
		                <input type="hidden" name="typeHidden" value="oralOrder" />
		                <input type="hidden" name="hiddenUser" value="{{user}}" />
		                <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
		                <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportOral}}" />
						<input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						<input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
		                <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
		                <button type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))" name="submit"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer les oraux par ordre de mérite</button>
		            </form>

 				</td>

 				<td>
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))"   ng-click="exportOral(5);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportOral || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-5.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>

 			<tr>
 				<th>Exporter la liste finale par ordre de mérite    </th>
 				<td>
  						
  					<form method="POST" action="tpl/listFinaleOrder.php" target="_blank">

		                <input type="hidden" name="hidden" value="{{candidatsFinaleOrder}}" />
		                <input type="hidden" name="hiddenAtt" value="{{candidatsFinaleAttenteOrder}}" />
		                <input type="hidden" name="typeHidden" value="finaleOrder" />
		                <input type="hidden" name="hiddenUser" value="{{user}}" />
		                <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
		                <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.exportFinale}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
						    <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
		                <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
		                <button type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportFinale || paramsDroit.ctl_all ))" name="submit"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Imprimer résultat finale par ordre de mérite</button>
		            </form>

 				</td>

 				<td>
 					<button ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportFinale || paramsDroit.ctl_all ))"   ng-click="exportOral(6);" class="btn btn-info btn-xs pull-left" download=""><i class="fa fa-download"></i> Exporter vers Excel</button>&nbsp;&nbsp;

 					<a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportFinale || paramsDroit.ctl_all ))"  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hireEdit.hire_date |  date:'dd-MM-yyyy'}}-{{hireEdit.id}}-6.xlsx"   class="btn btn-success btn-xs pull-left" download=""> <i class="fa fa-download"></i> Ouvrir le fichier</a>

 				</td>
 			</tr>
 			<tr>
 				<th>PV  </th>
 				<td>
  						
  					<form method="POST" action="tpl/pv.php" target="_blank" >

		                <input type="hidden" name="hiddenHire" value="{{hireForPv}}" />
		                <input type="hidden" name="hiddenCommission" value="{{commissions}}" />
		                <input type="hidden" name="hiddenMar" value="{{publication}}" />
		                <input type="hidden" name="hiddenpvFirstExam" value="{{pvFirstExam}}" />
		                <input type="hidden" name="hiddenFormule" value="{{formule}}" />
		                <input type="hidden" name="hiddenExamTwo" value="{{candidatsOralOrder}}" />
		                <input type="hidden" name="hiddenNbreP" value="{{nbre_postuled}}" />
		                 <input type="hidden" name="hiddenUserRole" value="{{paramsDroit.pvs}}" />
						    <input type="hidden" name="hiddenUserSuper" value="{{role}}" />
		                <input type="hidden" name="typeHidden" value="pv" />
		                <input type="hidden" name="hiddenUser" value="{{user}}" />
		                <input type="hidden" name="hiddenLogo" value="{{logoFilename}}" />
		                <input type="hidden" name="hiddenUniversity" value="{{university_name}}" />
		                <button type="submit" name="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.pvs || paramsDroit.ctl_all ))" class="btn btn-default btn-xs" ><i class="fa fa-print"></i> Gestion des PVs</button>
		            </form>

 				</td> 

 				<td>----</td>
 			</tr>
 
 		</table>
     
                 
                 
                 
                 
                 
      </div>
   </div>


  </div>
  </div>

     