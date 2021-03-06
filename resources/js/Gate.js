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

    getImageUser(){
        return this.user.image;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'user';
    }
    
    isAdminOrUser(){
        if(this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }
}

