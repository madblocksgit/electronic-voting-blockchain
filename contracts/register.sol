pragma solidity 0.5.16;

contract register {
	bytes32[] name;
	bytes32[] email;
	bytes32[] mobile;
	bytes32[] aadhaar;
	bytes32[] dob;
	bytes32[] gender;
	bytes32[] password;
	mapping(address => bool) internal users;

	function addAccount(bytes32 _name, bytes32 _email, bytes32 _mobile, bytes32 _aadhaar, bytes32 _dob, bytes32 _gender, bytes32 _password) public {
		require (!users[msg.sender]);
		
		users[msg.sender]=true;
		name.push(_name);
		email.push(_email);
		mobile.push(_mobile);
		aadhaar.push(_aadhaar);
		dob.push(_dob);
		gender.push(_gender);
		password.push(_password);
	}

	function viewAccounts() public view returns(bytes32[] memory, bytes32[] memory,bytes32[] memory) {
		return(name,aadhaar,password);
	}

	function loginAccount(bytes32 _aadhaar, bytes32 _password) public view returns(bool){
		
		uint i;
		uint j=0;

		require(users[msg.sender]);

		if(password.length>0) {
			for(i=0;i<password.length;i++) {
				if((password[i])==(_password)) {
					j=i;
				}
			}
		
		
			if(password[j]==_password && aadhaar[j]==_aadhaar) {
				return true;
			}
			else {
				return false;
			}
		}
	}
}
