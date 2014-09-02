
declare

% solucionar el Kakuro
fun{Sol Kakuro}
% crea una lista(fila) de N+1 elementos y un dominio especifico si N es mayor a 1, donde el primer elemento es el valor que debe sumar la fila
   fun{Fila NElementos Suma}
      if NElementos > 1 then
	 Lim in
	 if Suma < 10 then Lim=Suma-1
	 else Lim = 9 end
	 Suma|{FD.list NElementos 1#Lim}
      else Suma|[Suma] end
   end
%crear todas las filas(sumas horizontales) del Kakuro
   fun{CrearFilas Prop}
      if Prop == nil then nil
      else{Fila Prop.1.pos Prop.1.suma}|{CrearFilas Prop.2} end
   end
%crea una lista de acuerdo al campo columnas del registro kak,
%el parametro Pos corresponde a los campos pos del registro c del campo columnas de kak, y esta dado por A#B donde A es la fila y B el elemento de A
%Filas corresponde a la invocacion de CrearFilas
   fun{Columna Pos Filas}
      case Pos of nil then nil
      []A#B|_ then {Nth {Nth Filas A} B+1}|{Columna Pos.2 Filas} end   
   end
% crea todas las columnas mapeadas a las posiciones que le corresponde segun el Kakuro entrada
   fun{MapColumnas Prop Filas}
      if Prop == nil then nil
      else Prop.1.suma#{Columna Prop.1.pos Filas}|{MapColumnas Prop.2 Filas} end 
   end

in   
   proc{$ Out}   
      Out = {CrearFilas Kakuro.filas}  % todas las filas (sumas horizonatales) 
      {ForAll Out proc{$ F}		      
		     {FD.sum F.2 '=:' F.1} %F.1 corresponde al valor que debe sumar F.2
		     {FD.distinct F.2} % F.2 es la lista que se debe completar 
		  end}
      {ForAll {MapColumnas Kakuro.columnas Out} % se aplica algo similar para las columnas(sumas verticales)
                  proc{$ S#C}		    
		     {FD.sum C '=:' S} % S es el valor que debe sumar C
		     {FD.distinct C} % C es la lista mapeada con las posiciones en las filas
		  end}
      {FD.distribute ff {Flatten Out}}
   end
end

% entrada

Kakuro = kak(
	filas:[f(pos:3 suma:9)
	       f(pos:3 suma:13)
	       f(pos:2 suma:13)
	       f(pos:3 suma:7)
	       f(pos:3 suma:19)]
	columnas:[c(pos:[1#1 2#1 3#1] suma:9)
		  c(pos:[1#2 2#2 3#2 4#1 5#1] suma:34)
		  c(pos:[1#3 2#3] suma:4)
		  c(pos:[4#2 5#2] suma:11)
		  c(pos:[4#3 5#3] suma:3)]   
	)

{ExploreAll {Sol Kakuro}}