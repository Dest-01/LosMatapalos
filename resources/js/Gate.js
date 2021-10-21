export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'usuario';
    }
    
    isAdminOrUser(){
        if(this.user.type === 'usuario' || this.user.type === 'admin'){
            return true;
        }
    }
}

