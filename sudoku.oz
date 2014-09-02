
declare
% PRIMER PUNTO
fun{Sol S}
   % obtener una columna
   fun{Col Tab Pos}
      if Tab == nil then nil
      else {Nth Tab.1 Pos}|{Col Tab.2 Pos} end
   end
% obtner todas las columnas
   fun{Columnas Tab I}
      if I == 10 then nil
      else {Col Tab I}|{Columnas Tab I+1} end   
   end
% obtener indices para los elementos de una region
   fun{GetIndice I J LY}
      if J == LY then i(I+1 LY-3)
      else i(I J) end
   end
%obtener una region
   fun{Region Tab I J LX LY} 
      E in
      E = {GetIndice I J LY}   
      if E.1 == LX then nil
      else {Nth {Nth Tab E.1} E.2}|{Region Tab E.1 1+E.2 LX LY} end   
   end
%indices inciales para cada region
   fun{IndexInicial R}
      M in
      M = R mod 3
      case M of 1 then i(R 1)
      [] 2 then i(R-1 4)
      else i(R-2 7) end
   end
%obtener todas las regiones
   fun{Regiones Tab R}
      if R == 10 then nil
      else
	 E in
	 E = {IndexInicial R}
	 {Region Tab E.1 E.2 E.1+3 E.2+3}|{Regiones Tab R+1} end
   end
in   
   proc{$ Tab}     
      Tab = {S} % asignar el tablero parametro
      {ForAll Tab proc{$ E}
		     E:::1#9
		     {FD.distinct E}
		  end} % para cada fila establecer que sus elementos tengan un dominio de 1 a 9 y ademas sean numeros diferentes 
      {ForAll {Columnas Tab 1} proc{$ E} {FD.distinct E} end} % para cada columna igualmente establecer la distincion interna 
      {ForAll {Regiones Tab 1} proc{$ E} {FD.distinct E} end}% e igual para cada region(caja) 
      {FD.distribute ff {Flatten Tab}}
   end
end
% tablero parametro(no es el del taller), extraido de un juego de sudoku para pc, nivel Very Hard
fun{Sudoku}
  [[9 _ _ 6 _ _ _ _ 8]
   [_ _ _ _ _ _ _ 4 _]
   [_ _ 3 _ _ 8 _ 5 _]
   [5 _ _ 7 _ _ 9 _ _]
   [_ _ 9 _ _ _ 2 _ _]
   [_ _ 6 _ _ 3 _ _ 5]
   [_ 2 _ 1 _ _ 3 _ _]
   [_ 1 _ _ _ _ _ _ _]
   [8 _ _ _ _ 5 _ _ 2]]
end

{ExploreAll {Sol Sudoku}}
