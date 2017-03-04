// JavaScript Document

           $(function () {
               $(".manage_tabletwo:eq(0) tr").each(function (i) {
                 if (i%2 != 0) {
                        $(this).css("background-color","#e6e5f4");
                   } else {
                        $(this).css("background-color","#e5ecf4");
                   }
               });

              $(".manage_tabletwo:eq(1) tr").each(function (i) {
                   if (i%2 != 0) {
                        $(this).css("background-color","#e6e5f4");
                   } else {
                        $(this).css("background-color","#e5ecf4");
                   }
             });

               $(".manage_tabletwo:eq(2)").find("tr:even").css("background-color","#e6e5f4").end().find("tr:odd").css("background-color","#e5ecf4");

               $(".manage_tabletwo:eq(3) tr").find("td:even").css("background-color","#e6e5f4").end().find("td:odd").css("background-color","#e5ecf4");
           });