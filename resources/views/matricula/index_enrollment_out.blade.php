<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FORMULARIO DE INSCRIPCIÓN</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {!! Html::style('lib/enrollmentStudent/outside.css') !!}
        {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') !!} 
        {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css') !!} 
        
    </head>
    <body>
        

    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-11 col-md-10 col-lg-10 col-xl-8 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">FORMULARIO DE INSCRIPCI&Oacute;N</h2>
                <p>Por favor diligencie todos los campos</p>
                <form id="msform" style="padding:15px;">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Personal</strong></li>
                        <li id="personal"><strong>Familiar</strong></li>
                        <li id="payment"><strong>Imagen carnet</strong></li>
                        <li id="confirm"><strong>Finalizar</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Informacion Personal :</h2>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="fieldlabels">Registro Civil o TI No: <span class="text-danger">*</span></label> <input type="number" name="dni" id="dni" placeholder="Identificacion" /> </label>                                                     
                            </div>                            
                            <div class="col-lg-6">
                                <label class="fieldlabels">Expedido en: <span class="text-danger">*</span></label> <input type="text" name="expedidoEn" placeholder="Expedicion" /> </label>                                                     
                            </div>
                        </div>

                        <div class="row">

                        <div class="col-lg-3">
                                <label class="fieldlabels">Primer nombre: <span class="text-danger">*</span></label> <input type="text" name="firstName" placeholder="Primer nombre"  /></label>     
                            </div>
                            <div class="col-lg-3">
                                <label class="fieldlabels">Segundo nombre: <span class="text-danger">*</span></label> <input type="text" name="secondName"  placeholder="Segundo nombre"  /></label> 
                            </div>
                            <div class="col-lg-3">
                                <label class="fieldlabels">Primer Apellido: <span class="text-danger">*</span></label> <input type="text" name="firstLastName"  placeholder="Primer apellido"  /></label> 
                            </div>
                            <div class="col-lg-3">
                                <label class="fieldlabels">Segundo Apellido: <span class="text-danger">*</span></label> <input type="text" name="secondLastName"  placeholder="Segundo apellido"  /></label> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="fieldlabels">Fecha nacimiento: <span class="text-danger">*</span></label> <input type="date" name="dateBirthDay" placeholder="Fecha"   /></label> 
                            </div>
                            <div class="col-lg-6">
                                <label class="fieldlabels">Ciudad: <span class="text-danger">*</span></label> <input type="text" name="city"  placeholder="Ciudad"  /></label> 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="fieldlabels">Sexo:  <span class="text-danger">*</span></label> 
                                <select class="form-control" name="sexo">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="fieldlabels">Comuna: <span class="text-danger">*</span></label> <input type="number" name="comuna"  placeholder="Comuna"  /></label> 
                            </div>
                            <div class="col-lg-3">
                                <label class="fieldlabels">Estrato: <span class="text-danger">*</span></label> <input type="number" name="estrato" placeholder="Estrato"  /></label> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="fieldlabels" >Direcci&oacute;n Residencia: <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="direccion" >
                            </div>
                        </div>
                        

                        <div class="row">
                        <div class="col-lg-4">
                                <label class="fieldlabels">Barrio: <span class="text-danger">*</span></label> 
                                <select class="form-control" name="barrio">
                                    <option value="">Seleccione</option> 
                                    @foreach($barrios as $bar)
                                    <option value="{{ $bar->id_barrio }}">{{ $bar->nombre }}</option> 
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-lg-4">
                            <label class="fieldlabels">Tel. fijo: <span class="text-danger">*</span></label> <input type="number" name="tel"  placeholder="Telefono"  /></label> 
                        </div>                        
                        <div class="col-lg-4">
                            <label class="fieldlabels">Celular : <span class="text-danger">*</span></label> <input type="number" name="celular"  placeholder="Celular"  /></label> 
                        </div> 
                        </div>
                        

                        <div class="row">
                        <label class="col-lg-3 fieldlabels">
                                El aspirante vive con : <span class="text-danger">*</span>
                        </label>
                        
                        <label class="col-lg-9 fieldlabels" style="display:flex;">
                                Padres
                                <input class="form-control" type="checkbox"  value="Padres" style="height: 15px;">
                                Abuelos
                                <input class="form-control" type="checkbox"  value="Abuelos" style="height: 15px;">
                                Hermanos
                                <input class="form-control" type="checkbox"  value="Hermanos" style="height: 15px;">
                                Otros
                                <input class="form-control" type="checkbox"  value="Otros" style="height: 15px;">
                        </label>                                                                                            
                        </div>
                        
                        <div class="row">
                        <label class="col-lg-4 fieldlabels">
                        Colegio de donde proviene: <span class="text-danger">*</span>
                        </label>
                        
                        <label class="col-lg-8 fieldlabels">
                            <input  type="text" class="form-control" name="colegioProviene" placeholder="Institucion Educativo">
                        </label>
                        </div>

                        <div class="row">
                                <label class="col-lg-4 fieldlabels">
                                Cu&aacute;ntos hermanos tiene: 
                                </label>
                                <div class="col-lg-2">
                                    <input type="number" name="nmHermanos" placeholder="Nro." >
                                </div>
                                <label class="col-lg-4 fieldlabels">
                                Qu&eacute; lugar ocupa entre ellos:
                                </label>
                                <div class="col-lg-2">
                                    <input type="number" name="lugarOcupa" placeholder="Nro.">
                                </div>
                        </div>

                        <div class="row">
                        <div class="col-lg-6">
                                <label class="fieldlabels">Tiene hermanos en el Instituto Moderno Desepaz : </label> 
                                <select class="form-control" name="hermanosModerno">
                                    <option value=""></option>                                    
                                    <option value="SI">SI</option>                                    
                                    <option value="NO">NO</option>                                    
                                </select>
                        </div>
                        <div class="col-lg-6">
                                <label class="fieldlabels">Parientes : </label> 
                                <select class="form-control" name="parientes">
                                    <option value=""></option>                                    
                                    <option value="SI">SI</option>                                    
                                    <option value="NO">NO</option>                                    
                                </select>
                        </div>
                        </div>


                        
                        <div class="row pt-2">
                        <div class="col-lg-8">
                        <label class="fieldlabels"> A qu&eacute; comunidad religiosa pertenece : <span class="text-danger">*</span></label> 
                        
                        <select class="form-control" name="comunidadReligiosa">
                            <option value="Cristiana">Cristiana</option>
                            <option value="Catolica">Catolica</option>
                            <option value="Protestante">Protestante</option>
                            <option value="Otras">Otras</option>
                        </select>
                        </div>
                        </div>


                        <div class="row pt-5">
                            <label class="fieldlabels col-lg-9">
                                El aspirante presenta discapacidad, integrados y no integrados a la educación formal ?
                            </label> 
                            <div class="fieldlabels col-lg-1">
                                <label class="switch ">
                                    <input type="checkbox" class="primary switchDs">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <label class="col-lg-10 fieldlabels pnlDs pt-2" style="display:none;">
                            Visual
                                <input class="form-control" name="discapacidad" type="checkbox"  value="visual" style="height: 15px;">
                                Motora
                                <input class="form-control" name="discapacidad" type="checkbox"  value="motora" style="height: 15px;">
                                Cognitiva
                                <input class="form-control" name="discapacidad" type="checkbox"  value="cognitiva" style="height: 15px;">
                                Autismo
                                <input class="form-control" name="discapacidad"  type="checkbox"  value="autismo" style="height: 15px;">
                                Múltiple
                                <input class="form-control" name="discapacidad" type="checkbox"  value="multiple" style="height: 15px;">
                                Otra
                                <input class="form-control" name="discapacidad" type="checkbox"  value="otra" style="height: 15px;">                                
                        </label>
                        
                        <label class="fieldlabels col-lg-9">
                                El aspirante pertenece a un grupo Etnico?
                            </label> 
                            <div class="fieldlabels col-lg-1">
                                <label class="switch ">
                                    <input type="checkbox" class="primary switchEt">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        
                           <div class="col-lg-8 pnlEt" style="display:none;">
                           
                           <label class="fieldlabels">Grupos Étnicos</label> 
                           <select class="form-control">
                               <option value="">Seleccione</option>
                               @foreach($grupoEt as $gp)
                               <option value="{{ $gp->id_grupo_etnico}}">{{ $gp->descripcion}}</option>
                               @endforeach
                           </select>

                           </div> 
                        </div> 
                        
                        <div class="row pt-5">
                            <div class="col-lg-6  offset-6">
                                <p class="text-danger">Nota:  Todos los campos con (*) son obligatorios</p>
                            </div>                            
                        </div>
                        
                        </div> <input type="button" name="next" class="next action-button" value="Siguiente" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <!--<div class="col-7">
                                    <h2 class="fs-title text-center">Informacion Familiar:</h2>
                                </div>                                -->
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="fs-title">DATOS DEL PADRE</h2>
                                </div>
                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Nombres y apellidos: </label>                             
                                <input type="text" name="fname" placeholder="Nombres y apellidos" /> 
                            </div>

                            <div class="col-lg-4">
                                <label class="fieldlabels">CC : </label>                             
                                <input type="number" name="fname" placeholder="Cedula de Ciudadania" /> 
                            </div>                            
                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">De : </label>                             
                                <input type="text" name="fname" placeholder="Lugar" /> 
                            </div>


                            <div class="col-lg-4">
                                <label class="fieldlabels">Profesi&oacute;n : </label>                             
                                <input type="text" name="fname" placeholder="Profesion" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Empresa donde labora : </label>                             
                                <input type="text" name="fname" placeholder="Empresa" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Celular : </label>                             
                                <input type="number" name="fname" placeholder="Celular" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Cargo : </label>                             
                                <input type="number" name="fname" placeholder="Cargo" /> 
                            </div>
                            

                            <div class="col-lg-4">
                                <label class="fieldlabels">Teléfono de la Empresa: </label>                             
                                <input type="number" name="fname" placeholder="Teléfono" /> 
                            </div>

                            </div>
                            

                            <div class="row">
                            <div class="col-lg-12">
                                <h2 class="fs-title">DATOS DEL MADRE</h2>
                            </div>
                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Nombres y apellidos: </label>                             
                                <input type="text" name="fname" placeholder="Nombres y apellidos" /> 
                            </div>

                            <div class="col-lg-4">
                                <label class="fieldlabels">CC : </label>                             
                                <input type="number" name="fname" placeholder="Cedula de Ciudadania" /> 
                            </div>
                            
                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">De : </label>                             
                                <input type="text" name="fname" placeholder="Lugar" /> 
                            </div>                                                                                                                                            


                            <div class="col-lg-4">
                                <label class="fieldlabels">Profesi&oacute;n : </label>                             
                                <input type="text" name="fname" placeholder="Profesion" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Empresa donde labora : </label>                             
                                <input type="text" name="fname" placeholder="Empresa" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Celular : </label>                             
                                <input type="number" name="fname" placeholder="Celular" /> 
                            </div>

                            
                            <div class="col-lg-4">
                                <label class="fieldlabels">Cargo : </label>                             
                                <input type="number" name="fname" placeholder="Cargo" /> 
                            </div>
                            

                            <div class="col-lg-4">
                                <label class="fieldlabels">Teléfono de la Empresa: </label>                             
                                <input type="number" name="fname" placeholder="Teléfono" /> 
                            </div>

                            </div>


                            <div class="row">
                            <div class="col-lg-12">
                                <h2 class="fs-title">DATOS DEL ACUDIENTE</h2>                                
                            </div>

    <div class="col-lg-6">
    <label class="fieldlabels">
            Parentesco:  <strong class="text-danger">*</strong>            
    </label>
        <select class="form-control">
                <option value="Madre">Madre</option>
                <option value="Padre">Padre</option>
            </select>

    </div>
        
    

                            <div class="col-lg-4">
                                <label class="fieldlabels">Nombres y apellidos: <strong class="text-danger">*</strong></label>                             
                                <input type="text" name="fname" placeholder="Nombres y apellidos" /> 
                            </div>

                            <div class="col-lg-4">
                                <label class="fieldlabels">CC : <strong class="text-danger">*</strong></label>                             
                                <input type="number" name="fname" placeholder="Cedula de Ciudadania" /> 
                            </div>


                            <div class="col-lg-4">
                                <label class="fieldlabels">Celular :  <strong class="text-danger">*</strong></label>                             
                                <input type="number" name="fname" placeholder="Celular" /> 
                            </div>

                            <div class="col-lg-4">
                                <label class="fieldlabels">Direccion :  <strong class="text-danger">*</strong></label>                             
                                <input type="number" name="fname" placeholder="Direccion de recidencia" /> 
                            </div>


                            </div>




                        </div> <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Anterior" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Foto de carnet:</h2>
                                </div>
                                
                            </div> <label class="fieldlabels">Foto:</label> <input type="file" name="pic" accept="image/*">                             

                        </div> <input type="button" name="next" class="next action-button bg-success" value="GUARDAR" /> <input type="button" name="previous" class="previous action-button-previous" value="Anterior" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finalizar:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}  
    {!! Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js') !!}
    {!! Html::script('lib/enrollmentStudent/outside.js') !!}
    {!! Html::script('//cdn.jsdelivr.net/npm/sweetalert2@10') !!}      
    <script src="{{ asset('/js/validate.min.js')}}"></script>
    <script src="{{ asset('/js/validator.messages.js')}}"></script>
    </body>
</html>