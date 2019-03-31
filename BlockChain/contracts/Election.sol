pragma solidity 0.4.25;

contract Election {
    // Model a Candidate
    struct Candidate {
        uint id;
        string name;
        uint voteCount;
        string symbol;
    }

    // Store accounts that have voted
    mapping(address => bool) public voters;
    // Store Candidates
    // Fetch Candidate
    mapping(uint => Candidate) public candidates;
    // Store Candidates Count
    uint public candidatesCount;

    // voted event
    event votedEvent (
        uint indexed _candidateId
    );

    constructor () public {
        addCandidate("Vignesh","../images/candidate1.jpeg");
        addCandidate("Lachu","../images/candidate2.jpeg");
        addCandidate("Venkatesh","../images/candidate3.jpeg");
        // addCandidate("Lachu");
        // addCandidate("Venkatesh");
        // addCandidate("SaranrajShri");
    }

    function addCandidate (string _name,string _symbol) private {
        candidatesCount ++;
        candidates[candidatesCount] = Candidate(candidatesCount, _name, 0,_symbol);
    }

    function vote (uint _candidateId) public {
        // require that they haven't voted before
        require(!voters[msg.sender]);

        // require a valid candidate
        require(_candidateId > 0 && _candidateId <= candidatesCount);

        // record that voter has voted
        voters[msg.sender] = true;

        // update candidate vote Count
        candidates[_candidateId].voteCount ++;

        // trigger voted event
        emit votedEvent(_candidateId);
    }
}
