%%
%% Example: Queens
%%

 declare
 fun {Queens N}
    proc {$ Row}
       % Creando  registros de tamaño N
       L1N ={MakeTuple c N} 
       %LM1N={MakeTuple c N}
    in
       %% Row = queens(n1:N1 n2:N2 n3:N3 ...)
       %% Row ::: 1#N
       {FD.tuple queens N 1#N Row}
       

       {FD.distinct Row}

        {For 1 N-1 1
 	proc {$ I}
 	   {For I+1 N 1
 	    proc{$ J}
 	       Row.I - Row.J \=: I - J
 	       Row.I - Row.J \=: J - I
 	    end
 	   }
 	end
 	}
	         
       {FD.distribute naive Row}
    end
 end

 {Browse {SearchOne {Queens 8}}}
