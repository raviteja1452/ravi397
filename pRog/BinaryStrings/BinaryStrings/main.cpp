//
//  main.cpp
//  BinaryStrings
//
//  Created by Raviteja Bejgum on 07/07/16.
//  Copyright © 2016 Raviteja Bejgum. All rights reserved.
//

#include <iostream>

using namespace std;

char A[101] = {};
int J = 0;
int binarystrings(int n,int k){
    //cout<< "In Binary String Function"<<endl;
    if(n == k){
        //cout << "n == k" << endl;
        A[k] = '\0';
        J = J + 1;
        cout << J << ":";
        printf("%s\n",A);
    }else{
      //  cout << "n != k" << endl;
        cout << k << endl;
        A[k] = '0';
        binarystrings(n,k+1);
        A[k] = '1';
        binarystrings(n,k+1);
    }
    return 0;
}
int main(int argc, const char * argv[]) {
    int n = 2;
    //cout << "Enter the value of n < 100";
    //cin >> n;
    cout << "Entering Binary String function" << endl;
    binarystrings(n,0);
    return 0;
}
