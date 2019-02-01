     // codigo para cargar las notificaciones en la barra usand jquery y ajax
    $(document).ready(function() 
    {

        function buscar(query)
        {
            $.ajax({
                url:"busqueda_cards.php",
                method:"POST",
                data:{query:query},
                // dataType: "json",
                success:function(data)
                {
                    $('#tickets').html(data);
                },
                error: function (req, status,error) 
                {
                    alert(req.responseText);            
                }  
            });
        }

        function buscar_investigador(query) 
        {
            $.ajax({
                url:"busqueda_invest.php",
                method:"POST",
                data:{query:query},
                // dataType: "json",
                success:function(data)
                {
                    $('#reportes_cards').html(data);
                },
                error: function (req, status,error) 
                {
                    alert(req.responseText);            
                }  
            });
            
        }



        $('#buscar_ticket').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            buscar(search);
        }
        else
        {
            buscar();            
        }
    });

    $('#buscar_investigador').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            buscar_investigador(search);
        }
        else
        {
            buscar_investigador();            
        }
    });



        function load_investigators_cards(view = '')
        {
            $.ajax({                                        
                url: "load_invest.php",
                method: "POST",
                data: 
                {
                    view: view
                },
                dataType: "json",
                success: function (data)
                {
                    // poner las cards en el html
                    $("#reportes_cards").html(data.list);
                },
                // manejar errores de php y mostrarlos en pantalla 
                error: function (req, status, error)
                {
                    alert(req.responseText);                        
                }                    
            });  
        }



        // función para traer los datos y ponerlos en pantalla
        function load_unseen_notification(view = '') 
        {
            // se usa ajax para traer los datos sin necesidad de recargar la página
            $.ajax({
                // la data de este archivo
                url: "cargar_notif.php",
                // se solicita por este método
                method: "POST",
                // la data se manda en esta variable
                data: 
                {
                    view: view
                }, 
                // se solicita que sea del tipo json
                dataType: "json",
                // en caso de obtener respuesta exitosa de la solicitud
                success: function (data) 
                { 
                    // console.log(data);
                    
                    // se le pone los datos recibidos en la variable data a la barra con id notif
                    $('#notif').html(data.notification);
                    // comprobar si las notificaciones sin ver son > 0 para ponerle numeros
                    if (data.unseen_notification > 0)  
                    {
                        // agrega los números de notificaciones sin ver
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

        function Load_ticket_cards(view = '')
        {            
            $.ajax({                                        
                    url: "load_cards.php",
                    method: "POST",
                    data: 
                    {
                        view: view
                    },
                    dataType: "json",
                    success: function (data)
                    {
                        // poner las cards en el html
                        $("#tickets").html(data.list);
                    },
                    // manejar errores de php y mostrarlos en pantalla 
                    error: function (req, status, error)
                    {
                        alert(req.responseText);                        
                    }                    
                });                        
        }

        // cuando carga la página por primera vez se ejecuta la función
        load_unseen_notification();
        Load_ticket_cards();
        load_investigators_cards();

        //publicar tickets con el botón del modal
        $("#publicar_ticket").click(function ()
        {
            $("#comment_form").submit();         
        });

        $("#cancelar").click(function ()
        {
            $('#comment_form')[0].reset();            
        })

        // generar el selector de fecha
        $( "#date" ).datepicker();

        // manejar el e vento onclic en el botón de enviar
        $('#comment_form').on('submit', function(event)
        {
            var date = $("#date").val();
            // se quita el evento por defecto de send del formulario
            event.preventDefault();
            // se comprueba que los campos no estén vacíos
            if ($('#subject').val() != '' && $('#comment').val() != '' &&  date != "") 
            {
                // si no están vacíos se obtiene la data del formulario
                var form_data = $(this).serialize();
                // por medio de ajax se manda a php
                $.ajax
                ({
                    // se manda a esta clase
                    url: "insertar_notif.php",
                    // por este método
                    method: "POST",
                    // se manda la variable form_data que es lo que se obtuvo del formulario con .serialize()
                    data: form_data,
                    // en caso de exito
                    success: function(data) 
                    {
                        // se limpian los formularios y se cierra la barra de nuevo post
                        $('#comment_form')[0].reset();
                        $("#barra").attr('class', 'dropdown');
                        // y se vuelve a buscar por cambios para mostrar la nueva notificación
                        load_unseen_notification();
                        Load_ticket_cards();
                    }
                });             
            }
            // si hay espacios en blanco
            else 
            {
                alert("Todos los campos son requeridos")
            }
            });
            // al darle clic al icono de notificacion se les cambia el status de visto a sin ver
            $(document).on('click', '#notifi', function()
            {
                // se elemina el contador
                 $('.count').html('');
                //  en la base de datos se cambia todos los no visto, por visto
                 load_unseen_notification('yes');
            });
            
            // jquery para enfocar en el primer elemento del formulario al activar el modal
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
              })

            // $("#btn_reporte").click(function ()

            // {
            //     host = document.location.hostname;
            //     path = host + "/reporte.php";
            //     window.location.href = path;
                
            // })

            //cada 5 segundos se revisa por nuevas notificaciones
            setInterval(function()
            {
                load_unseen_notification();
            }, 5000);
        });