   
function define_stages(){
   
    ///////////////////////// Stage 0 /////////////////////////      
             if ( answer == "exit") 
            {
                number = 13;
                stage  = 2;
            }       
    ///////////////////////// Stage 1 /////////////////////////
           if (stage == 1  && answer == "no") 
            {
                number = 3;
                stage  = 2;
            }
            else if (stage == 1) 
            {
            number = 2;
            stage  = 1;
            }
    ///////////////////////// Stage 2 /////////////////////////
            if (stage == 2 && answer == "IRC") 
		    {
                stage   = 3;
                number  = 4;
		    }
		    if (stage == 2 && answer == "email")
		    {
                stage  = 3;
                number = 5;
		    }
             if (stage == 2 && answer == "ftp") 
		    {
                stage   = 3;
                number  = 6;
		    }
    ///////////////////////// Stage 3 IRC /////////////////////

            if (stage == 3 && answer == "view source") 
		    {
                stage   = 4;
                number  = 7;
                irc_complete = true;
		    }
    ///////////////////////// Stage 3 email ///////////////////      
		    if (stage == 3 && answer == "zxmbf2.gif")
		    {
                stage  = 4;
                number = 8;
                email_complete = true;
		    }
    ///////////////////////// Stage FTP ////////////////////////
            if (stage == 3 && answer == 66) 
		    {
                stage   = 4;
                number  = 9;
                ftp_complete = true;
     		}
            if (stage == 3 && answer > 66) // too low
            {
                stage   = 3;
                number  = 10;
                attempts =1;
     		}
            if (stage == 3 && answer < 66) // too high
	        {
                stage   = 3;
                number  = 11;
                attempts=1;
         	}
            if (stage == 3 && attempts<0 ) // run out of attempts
                {
                   stage   = 1;
                   number  = 12;
                 //  attempts = 10;           
                   irc_complete = false;
                   email_complete = false;
                   ftp_complete = false;
         		}
////////////////////////// Stage 4 ///////////////////////// 
            if  (irc_complete == true && email_complete == true && ftp_complete == true) 
            {
                stage   = 5;
                number  = 14;
                complete = true;
            }
/////////////////////////////////////////////////////////////

}
