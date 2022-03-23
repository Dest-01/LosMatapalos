export default class Gate{

    constructor(user){
        this.user = user;
    }
    nameUser(){
        return this.user.name;
    }
    getEmailUser(){
        return this.user.email;
    }
    
    getIdUser(){
        return this.user.id;
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

