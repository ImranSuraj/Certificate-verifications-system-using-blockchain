//declare the solidity compiler version
pragma solidity ^0.5.17;

//declare the contract
contract Authenticity {

  //declare the event that will be fired when a file is certified.
  event FileCertified(uint id,string name,string FileHash,string date,string course);

  //declare a structured data that describes a certified file
  struct FileCertificate {
    uint  id;
   string name;
   string date;
   string course;
   
  }

  //declare an object that will store the file certificates by hash
  mapping (string => FileCertificate) fileCertificatesMap;
   // Define the address that is allowed to add data to the smart contract
    address public owner;

    // Constructor function that sets the owner to the deployer of the smart contract
    constructor() public {
        owner = msg.sender;
    }

    // Modifier function that restricts access to the owner only
    modifier onlyOwner() {
        require(msg.sender == owner, "Only owner is allowed to add data.");
        _;
    }


  //function that allows users to certify a file
  function certifyFile(uint id,string memory name,string memory FileHash,string memory date,string memory course) public onlyOwner{
    FileCertificate memory newFileCertificate = FileCertificate(id,name,date,course);
    fileCertificatesMap[FileHash] = newFileCertificate;
    emit FileCertified(id,name,FileHash,date,course);
  }

  //function that allows users to verify if a file has been certified before
  function verifyFile(string memory FileHash) public view returns (string memory,string memory,
  uint,string memory,string memory) {
      
       if (fileCertificatesMap[FileHash].id > 0) {
             return ("yes",fileCertificatesMap[FileHash].name,
             fileCertificatesMap[FileHash].id,fileCertificatesMap[FileHash].date,
             fileCertificatesMap[FileHash].course);
        }
        else{

            return ("no"," ",0," "," ");
        }      
    
  }


}
