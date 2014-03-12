
#if !defined(BASICMANAGER_H_INCLUDED)
#define BASICMANAGER_H_INCLUDED

#if _MSC_VER > 1000
#pragma once
#endif // _MSC_VER > 1000

#include <windows.h>
#include "Client.h"
#include "Map.h"


class CBasicManager 
{
	friend class CClient;
	
public:
	HANDLE m_hEvent;
	int m_id;//�Լ���id
	BOOL b_quit;//��ʾ�Ƿ�����Լ�
	CClient	*m_pClient;
	void Post(LPCWSTR lpurl,char* strPostData);
	CBasicManager(CClient*);
	virtual ~CBasicManager();
	virtual void OnReceive(LPBYTE,DWORD);
	void WaitEvent();

};

#endif