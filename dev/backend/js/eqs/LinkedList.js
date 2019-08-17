//Linked-List
function LinkedList(){
	this._length = 0;
	this._head = null;
}

LinkedList.prototype = {
	add : function (data){
		var node = {
			data : data,
			next : null
		};
		if(this._head == null){
			this._head = node;
		}else{
			current = this._head;
			while(current.next){
				current = current.next;
			}
			current.next = node;
		}
		this._length++;
	},
	
	check : function (data){
		if(this._head != null){
			current = this._head;
			
			while(current){
				if(current.data == data){
					return true;
				}else{
					current = current.next;
				}
			}
			return false;
		}else{
			return false;
		}
	},

	item : function (index){
		if(index >= 0 && index < this._length){
			var current = this._head,
				i = 0;
			while(i++ < index){
				current = current.next;
			}
			return current.data;
		}
		else{
			return null;
		}
	},
	
	remove : function (data){
		if(this._head != null){
			var current = this._head,
				previous = current;
			while(current){
				if(current.data == data){
					if(previous == current){
						this._head = current.next;
					}else{
					previous.next = current.next;
					}
					current.data = null;
					current.next = null;
					current = null;
					this._length--;
					break;
				}else{
					previous = current;
					current = current.next;
				}
			}
		}else{}
		return;
	},
	size : function(){
		return this._length;
	}
};