# whenever we are working with API's (Application programming Interface), we must have a clear concept about it .

        # API- a tool that makes a website's data degistable for a computer. through it, a computer can view and edit data just like a person can by loading pages and submitting forms.

        # HOW AN API WORKS?
            # An API has no view. it only returns response. it actually send request to the website and get the response. there are two types of API( REST API & SOAP API)

                # SOAP API- SOAP is the Simple Object Access Protocol, a messaging standard defined by the World Wide Web Consortium and its member editors. SOAP uses an XML data format to declare its request and response messages, relying on XML Schema and other technologies to enforce the structure of its payloads.

                # REST API- Representational state transfer is a software architectural style that describes a uniform interface between decoupled components in the Internet in a Client-Server architecture. Rest API is known as RESTFUL API as well, we will work on this here,
                    # there are 4 phases of a REST API
                        # --success, data, message, status ---, we will work accordingly .


    #STEP-1:
        # we need routes for API. we know every route is a request, so if we want to request anything we must have routes. for API we will define our routes in (api.php). we will have a route prefix (/api) here automatically.



    # we need a technology called POSTMAN , through which we shall send request and get response



    #STEP-2:
        # As we have decleared route/routes in the api.php we must write lt logic in the controller and for this we need to make a controller called ApiController where we shall define the methods of the routes and logics.


#----------------------------------------------------------------------------------------------







    # THIS METHOD IS TO GET THE USERS WITH API
    public function index(){
        # here we will get all the users in a variable
        $users=User::all();

        # now we will see that that we are getting the users or not bu dia-dum (dd)
        // dd($users);

        # we know that API return response. so we are returning response but we must define the data format here and which is json. it means we want to display the data in json format. as it will show multiple key value , we will use an array inside the json method.
        return response()->json([
            # here we will show the four phases of RESTFUL API
            'success'=> true,
            'data'=>$users, # the variable above where we stored all the users
            'message'=>'All the data loaded successfully',
            'status'=> 200, #status code 200 means successfull
        ]);

    }



#----------------------------------------------------------------------------------------------



    # THIS METHOD WILL SHOW THE SPECIFIC DATA(USER) WITH API

    # here we have to follow the parameter passing process. mainly there are 3 steps of passing parameter ---- 1. define(in the routes)--- 2. pass(in the links, blades)--- 3. receive (in the method). so in the method we have to receive the parameter we defined in the routes


    public function user($id){
        # now we will find the specific data via the parameter
        $user=User::find($id);
        // dd($user);




                        # now there can be two possibilities, 1- data found, 2- not found. for this we can if else. if data found then

                            // if($user){
                            //     #returning response ,json data format
                            // return response()->json([
                            //     'success'=>true,
                            //     'data'=>$user,
                            //     'message'=>'User has been found',
                            //     'status'=>200
                            // ]);
                            // }
                            // # and if no data is found , then
                            // else{
                            //     return response()->json([
                            //         'success'=>false,
                            //         'data'=>$user,
                            //         'message'=>'User has not been found',
                            //         'status'=>404, # this status code means error
                            //     ]);
                            // }



        # the above code is working perfectly . but here are some issues . if we have to use if else every time for finding the only user, then think if we have many many models and we need to develop an API for them . Then we need to write so many line of code. so , here comes a solution .

        # We shall use the OOP Concept to solve this problem. We shall use inheritance. as we can see that the ApiController is exdending the base controller , we shall define classes and write this 4 phase of rest api in the base Controller and create the instance/object  in this api controller.  Now move to base controller...


        # in the base controller we have defined two classes who will return with success or error. now we shall call the classes by creating the instance of those classes as we are inheriting.

        # we can use the (if else) condition here, but the problem is , it will show all the errors wehn the else condition is true. let's check



                                // if($user){
                                //     return $this->ResponseWithSuccess($user);
                                // }
                                // else{
                                //     return $this->ResponseWithError($user);
                                // }



        # to solve this problem, we shall use ( try and catch ) so that we can manage the errors. that means we can decide how much error should be showed while a website is in production or in developing mode.

        # we shall make the messages dyamic, and that's why in the base controller we shall pass another parameter.


        try {
            # this will try the first condition, if fails then it will go to catch
            return $this->ResponseWithSuccess($user,"User found");
        } catch (\Throwable $th) {
            #mit will catch the messages we want to display . we can customize the message or can only leave it to show the error only.
            return $this->ResponseWithError([],$th->getMessage());
        }

    }


#----------------------------------------------------------------------------------------------




    # THIS METHOD IS TO DELETE SPECIFIC DATA WITH API


    #following the parameter passing process
    public function delete($id){
        # find the user
        $user=User::find($id);

        # using try and catch instead of if else
        try {
            $user->delete();
            return $this->ResponseWithSuccess($user,"User deleted Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ResponseWithError([],$th->getMessage());
        }
    }



#----------------------------------------------------------------------------------------------




    # THIS METHOD IS TO CREATE ANY USER OR DATA WITH API
    public function store(Request $request){
        # using try and catch as we did earlier

        # to create an user/ any dta we must match the name of db and form. but in pai as there is no form so we can use (--- body---) in the POSTMAN and select the (--form data--) from below and write the field name same to same we write here.
        try {
            $user=User::Create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            return $this->ResponseWithSuccess($user,"user created successfully");
        }
        catch (\Throwable $th) {
            return $this->ResponseWithError([],$th->getMessage());
        }
    }


#----------------------------------------------------------------------------------------------



    # TIS IS TO UPDATE SPECIFIC DATA VIA API



    # in the POSTMAN , go to (row menu) and select (json format ) and send the data using the json format, update data and make a request

    # receive the parameter
    public function update(Request $request,$id){
        $user=User::find($id);
        // dd($user);
        try {
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            return $this->ResponseWithSuccess($user,"User Updated Successfully");
        }
        catch (\Throwable $th) {
            return $this->ResponseWithError([],$th->getMessage());
        }
    }
}
